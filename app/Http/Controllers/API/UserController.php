<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\MessageFileResource;
use App\Http\Resources\MessagesResource;
use App\Http\Resources\WorkFileResource;
use App\Models\Modal;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\User;
use App\Services\TgService;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WorkResource;
use App\Models\DbLog;
use App\Models\Message;
use App\Models\MessageFile;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function currentUser()
    {
        $user = Auth::user();
        if ($user->role == 'seller' && $user->status == 1) {
            if (count($user->projects) === 0) {
                $tariffs = $user->getActiveTariffs();
                if (count($tariffs) == 0) {
                    $tariff = Tariff::find(19);
                    SellerTariff::create([
                        'user_id' => $user->id,
                        'tariff_id' => $tariff->id,
                        'type' => $tariff->type,
                        'quantity' => $tariff->quantity,
                        'finish_date' => Carbon::now()->addDays($tariff->period),
                        'activation_date' => Carbon::now(),
                    ]);
                }
            }
        }

        $data = [
            'user' => new UserResource($user),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function show(User $user)
    {
        $data = [
            'user' => new UserResource($user),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function ban(User $user)
    {
        if ($user->status == 0 && $user->role == User::BLOGGER) {
            TgService::sendMessage($user->tgPhone->chat_id, "Ваша заявка на регистрацию была отклонена модератором.

Это связано с недостаточной статистикой вашего блога.
Попробуйте подать заявку снова, когда ваш блог станет более активным!");
        } else {
            $text = "Ваш аккаунт был заблокирован\\.

Если у вас есть вопросы, вы можете с нами связаться в [чате](https://t.me/adswap_admin)";
            TgService::sendMessage($user->tgPhone->chat_id, $text, [
                'disable_web_page_preview' => true,
                'parse_mode' => 'MarkdownV2',
            ]);
        }

        $user->status = -1;
        $user->save();
        return response()->json()->setStatusCode(200);
    }

    public function unban(User $user)
    {
        $user->status = 1;
        $user->save();
        TgService::notify($user->tgPhone->chat_id, 'Ваш аккаунт разблокировали');

        return response()->json()->setStatusCode(200);
    }

    public function delete(User $user)
    {
        $log_message = 'Удалён пользователь ' . $user->name . ', роль ' . $user->role . ', телефон' . $user->phone . ', email' . $user->email;
        DbLog::create(['text' => $log_message]);

        $user->forceDelete();
        return response()->json()->setStatusCode(200);
    }

    public function projects(User $user)
    {
        $validator = Validator::make(request()->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'product_name' => 'string|nullable',
            'statuses' => 'array|nullable',
            'statuses.*' => 'string',
            'work_statuses' => 'array|nullable',
            'work_statuses.*' => 'string',
            'is_blogger_access' => 'boolean|nullable',
            'order_by_created_at' => 'string|nullable',
            'status' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $projects = $user->projects();

        $validated = $validator->validated();

        if (!empty($validated['statuses'])) {
            $projects->whereIn('status', $validated['statuses']);
        }

        if (!empty($validated['is_blogger_access'])) {
            $projects->where('is_blogger_access', $validated['is_blogger_access']);
        }

        if (!empty($validated['product_name'])) {
            $projects->where('product_name', 'like', '%' . $validated['product_name'] . '%');
        }

        if (!empty($validated['project_type'])) {
            $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        if (!empty($validated['work_statuses'])) {
            $projects->whereHas('works', function (Builder $query) use ($validated) {
                $query->whereIn('status', $validated['work_statuses']);
            });
        }

        if (!empty($validated['status'])) {
            if ($validated['status'] == 'active') {
                $projects->where('status', '>=', 0);
            } else {
                $projects->where('status', '<', 0);
            }
        }

        if (isset($validated['order_by_created_at']) && !empty($validated['order_by_date'])) {
            $projects->orderBy('created_at', $validated['order_by_created_at']);
        } else {
            $projects->orderBy('created_at', 'desc');
        }

        $data = [
            'projects' => ProjectResource::collection($projects->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function works(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_by' => 'numeric|nullable',
            'is_active' => 'boolean|nullable',
            'order_by_last_message' => 'string|nullable',
            'project_type' => [Rule::in(Project::TYPES), 'nullable'],
            'category' => 'string|nullable',
            'product_name' => 'string|nullable',
            'with' => 'array|nullable',
            'with.*' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $works = $user->works();

        if (!empty($validated['created_by'])) {
            if ($validated['created_by'] < 0) {
                $works->where('created_by', '<>', $validated['created_by'] * -1);
            } else {
                $works->where('created_by', $validated['created_by']);
            }
        }

        if (isset($validated['is_active'])) {
            if ($validated['is_active']) {
                $works->whereNotNull('status');
            } else {
                $works->where('status', null);
            }
        }

        if (!empty($validated['order_by_last_message'])) {
            $works->orderBy('last_message_at', $validated['order_by_last_message']);
        } else {
            $works->orderBy('last_message_at', 'desc');
        }

        if (!empty($validated['project_type'])) {
            $project_ids = Project::whereHas('projectWorks', function (Builder $query) use ($validated, $user) {
                $query->where('type', $validated['project_type']);
            })->get('id')->pluck('id');

            $works->whereIn('project_id', $project_ids);
        }

        if (!empty($validated['product_name'])) {
            $works->whereHas('project', function (Builder $query) use ($validated) {
                $query->where('product_name', 'like', '%' . $validated['product_name'] . '%');
            });
        }

        if (isset($validated['category']) && !empty($validated['project_name'])) {
            $works->whereHas('project', function (Builder $query) use ($validated) {
                $query->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
            });
        }

        $data = [
            'works' => WorkResource::collection($works->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function messages(User $user, Work $work, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_by' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $messages = $work->messages();

        if (!empty($validated['order_by'])) {
            $messages->orderBy('created_at', $validated['order_by']);
        }

        $work->messages()->whereNull('viewed_at')->where('user_id', '<>', $user->id)->update(['viewed_at' => date('Y-m-d H:i')]);

        $message_collection = MessageResource::collection($messages->get());

        $specification_message = [
            'id' => 0,
            'message' => $work->message,
            'sender_id' => 1,
            'files' => WorkFileResource::collection($work->files),
            'is_specification' => true,
            'viewed_at' => null,
            'created_at' => null,
        ];
        $message_collection = array_merge([$specification_message], $message_collection)
        $data = [
            'messages' => $message_collection
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function notifications(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_by' => 'string|nullable',
            'viewed' => 'boolean|nullable',
            'limit' => 'numeric|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $notifications = $user->notifications()->where('viewed_at', null);

        if (!empty($validated['order_by'])) {
            $notifications->orderBy('created_at', $validated['order_by']);
        } else {
            $notifications->orderBy('created_at', 'desc');
        }

        if (!empty($validated['limit'])) {
            $notifications->offset(0)->limit($validated['limit']);
        }

        if (!empty($validated['viewed'])) {
            $notifications->whereNotNull('viewed_at');
        }

        $data = [
            'notifications' => NotificationResource::collection($notifications->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function viewNotification(User $user, Notification $notification = null)
    {
        if ($notification) {
            $notification->viewed_at = date('Y-m-d H:i');
            $notification->save();
        } else {
            $user->notifications()->update([
                'viewed_at' => date('Y-m-d H:i'),
            ]);
        }

        return response()->json()->setStatusCode(200);
    }

    public function brands(User $user)
    {
        if ($user->role != 'seller') {
            return response()->json(['message' => 'У пользователя должна быть роль селлер'])->setStatusCode(400);
        }

        $brands = $user->projects()->distinct()->where('marketplace_brand', '<>', null)->get(['marketplace_brand'])->pluck('marketplace_brand');

        $data = [
            'brands' => $brands,
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function storeMessage(User $user, Work $work, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'string|nullable',
            'img' => 'exclude_if:img,null|file|max:51200',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        if (!isset($validated['img']) && !isset($validated['message'])) {
            return response()->json(['message' => ['Введите сообщение или прикрепите файл']], 400);
        }

        if (isset($validated['img']) && !isset($validated['message'])) {
            $validated['message'] = 'Прикреплён файл';
        }

        $message = Message::create([
            'work_id' => $work->id,
            'user_id' => $user->id,
            'message' => $validated['message'],
        ]);

        if ($request->file('img')) {
            $product_image = $request->file('img');
            $image_path = $product_image->store('messages', 'public');
            MessageFile::create([
                'source_id' => $message->id,
                'type' => 0,
                'link' => $image_path,
            ]);
        }

        $work->update(['last_message_at' => date('Y-m-d H:i')]);
        Notification::create([
            'user_id' => $work->getPartnerUser($user->role)->id,
            'work_id' => $work->id,
            'type' => 'Новое сообщение',
            'text' => 'Вам поступило новое сообщение от ' . $user->name,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, 'Вам поступило новое сообщение от ' . $user->name);

        return response()->json()->setStatusCode(200);
    }

    public function sendFeedback()
    {
        $validator = Validator::make(request()->all(), [
            'phone' => 'string|required',
            'name' => 'string|required',
            'comment' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $message_text = "Форма обратной связи\n\nИмя: " . $validated['name'] . "\nТелефон: " . $validated['phone'] . "\nСообщение: " . $validated['comment'];
        $result = TgService::sendForm($message_text);
        return response()->json()->setStatusCode(200);
    }

    public function showModal(User $user, Modal $modal)
    {
        Redis::sadd('user.' . $user->id . '.modals', $modal->id);
        return response()->json()->setStatusCode(200);
    }
}
