<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Services\TgService;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\WorkResource;
use App\Models\DbLog;
use App\Models\Message;
use App\Models\MessageFile;
use App\Models\Notification;
use App\Models\Project;
use App\Models\Work;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ban(User $user)
    {
        $user->status = -1;
        $user->save();
        if ($user->status == 0 && $user->role == User::BLOGGER) {
            TgService::notify($user->tgPhone->chat_id, 'Вы не прошли модерацию');
        } else {
            TgService::notify($user->tgPhone->chat_id, 'Вы были забанены');
        }

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
            'product_name' => '',
            'statuses' => 'array|nullable',
            'statuses.*' => 'string',
            'is_blogger_access' => 'boolean|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $projects = $user->projects();

        $validated = $validator->validated();

        if (isset($validated['statuses']) && !empty($validated['statuses'])) {
            $projects->whereIn('status', $validated['statuses']);
        }

        if (isset($validated['is_blogger_access']) && !empty($validated['is_blogger_access'])) {
            $projects->where('is_blogger_access', $validated['is_blogger_access']);
        }

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $projects->where('product_name', 'like', '%' . $validated['project_name'] . '%');
        }

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        $data = [
            'projects' => ProjectResource::collection($projects->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function works(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_active' => 'boolean|nullable',
            'order_by_last_message' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $works = $user->works();

        if (isset($validated['is_active']) && !empty($validated['is_active'])) {
            if ($validated['is_active']) {
                $works->where('status', '<>', null);
            } else {
                $works->where('status', null);
            }
        }

        if (isset($validated['order_by_last_message']) && !empty($validated['order_by_last_message'])) {
            $works->orderBy('last_message_at', $validated['order_by_last_message']);
        }

        $data = [
            'works' => WorkResource::collection($works->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function messages(User $user, Work $work, Request $request) {
        $validator = Validator::make($request->all(), [
            'order_by' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $messages = $work->messages();

        if (isset($validated['order_by']) && !empty($validated['order_by'])) {
            $messages->orderBy('created_at', $validated['order_by']);
        }

        $data = [
            'messages' => MessageResource::collection($messages->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function notifications(User $user, Request $request) {
        $validator = Validator::make($request->all(), [
            'order_by' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $notifications = $user->notifications()->where('viewed_at', null);

        if (isset($validated['order_by']) && !empty($validated['order_by'])) {
            $notifications->orderBy('created_at', $validated['order_by']);
        } else {
            $notifications->orderBy('created_at', 'desc');
        }

        $data = [
            'notifications' => NotificationResource::collection($notifications->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function viewNotification(User $user, Notification $notification) {
        $notification->viewed_at = date('Y-m-d H:i');
        $notification->save();

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
            'message' => 'required|string',
            'img' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

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
}
