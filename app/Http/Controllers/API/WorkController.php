<?php

namespace App\Http\Controllers\API;

use App\Models\Blogger;
use App\Models\DeepLink;
use App\Models\FinishStats;
use App\Models\Message;
use App\Models\MessageFile;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectWork;
use App\Models\Work;
use App\Models\User;
use App\Services\TgService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function index(Project $project, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'statuses' => 'array|nullable',
            'statuses.*' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_work_id' => 'required|exists:project_works,id',
            'blogger_id' => 'exists:bloggers,id|nullable',
            'message' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $user = Auth::user();

        $project_work = ProjectWork::find($validated['project_work_id']);
        $project = $project_work->project;
        if (!$project) {
            return response()->json(['message' => 'Проект на который вы отправляете заявку удалён или заблокирован'])->setStatusCode(400);
        }

        if (!$project->is_blogger_access) {
            return response()->json(['message' => 'Проект на который вы отправляете не опубликован'])->setStatusCode(400);
        }

        if ($user->role == 'blogger') {
            if ($project_work->project->isSended()) {
                return response()->json(['message' => 'Заявка отправлена'])->setStatusCode(400);
            }
            $blogger_user = $user;
        } else {
            if (!isset($validated['blogger_id']) || empty($validated['blogger_id'])) {
                return response()->json(['message' => 'У пользователя должна быть роль blogger либо укажите blogger_id'])->setStatusCode(400);
            }
            $blogger_user = Blogger::find($validated['blogger_id']);
        }

        $work = Work::create([
            'project_id' => $project_work->project->id,
            'blogger_id' => $user->role == 'seller' ? $blogger_user->user->id : $user->id,
            'seller_id' => $user->role == 'seller' ? $user->id : $project_work->project->seller_id,
            'status' => null,
            'project_work_id' => $project_work->id,
            'message' => $validated['message'] ?? null,
            'created_by' => $user->id,
        ]);

        Notification::create([
            'user_id' => $work->getPartnerUser($user->role)->id,
            'type' => 'Новая заявка',
            'text' => 'Вам поступила новая заявка от ' . $user->name . ' на проект ' . $project_work->project->product_name,
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);

        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, 'Вам поступила новая заявка от ' . $user->name . ' на проект ' . $project_work->project->product_name);
        return response()->json(['id' => $work->id])->setStatusCode(200);
    }

    public function accept(Work $work)
    {
        $user = Auth::user();

        if ($work->created_by == $user->id) {
            return response()->json(['message' => 'Вы не можете принять свою заявку'])->setStatusCode(400);
        }

        if ($work->status) {
            return response()->json(['message' => 'Заявка уже принята или отклонена'])->setStatusCode(400);
        }

        $project_work = $work->projectWork;
        $seller_tariff = $user->getActiveTariffs($project_work->type);
        if ($seller_tariff && $seller_tariff->quantity !== 0) {
            $project_work->update(['finish_date' => $seller_tariff->finish_date]);
            if ($seller_tariff->quantity > 0) {
                $seller_tariff->update(['quantity' => $seller_tariff->quantity - 1]);
            }
        } else {
            if ($user->role == 'seller') {
                return response()->json(['message' => 'Вашего тарифа недостаточно для того, чтобы принять заявку'])->setStatusCode(400);
            } else {
                return response()->json(['message' => 'По данному проекту закончились места'])->setStatusCode(400);
            }
        }

        Notification::create([
            'user_id' => $work->getPartnerUser($user->role)->id,
            'type' => 'Новая заявка',
            'text' => $user->name . ' принял вашу заявку на проект ' . $work->project->product_name,
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);

        $work->status = Work::PENDING;
        $work->last_message_at = date('Y-m-d H:i');
        $work->save();

        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' принял вашу заявку' . ' на проект ' . $work->project->product_name);
        return response()->json('success')->setStatusCode(200);
    }

    public function start(Work $work)
    {
        $user = Auth::user();
        $work->accept($user);
        $work->update(['last_message_at' => date('Y-m-d H:i')]);
        Message::create([
            'work_id' => $work->id,
            'user_id' => 1,
            'message' => $user->name . ' готов приступить к работе',
        ]);

        if ($work->isBothAccepted() && $work->status = Work::PENDING) {
            $work->status = Work::IN_PROGRESS;
            $work->save();
            $message_text = 'Статус работы изменён на: <span style="color: var(--primary)">выполняется</span>';
            if ($work->projectWork->type != Project::FEEDBACK) {
                $deeplink = $this->createDeepLinkByWork($work);
                $link = request()->getSchemeAndHttpHost() . '/lnk/' . $deeplink->link;
                $message_text .= ' - ссылка для сбора статистики <a target="_blank" href="' . $link . '">' . $link . '</a>';
            }

            Notification::create([
                'user_id' => $work->getPartnerUser($user->role)->id,
                'type' => 'Согласование проекта',
                'text' => 'Можно приступать к выполнению проекта ' . $work->project->product_name,
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);

            $work->update(['last_message_at' => date('Y-m-d H:i')]);
            Message::create([
                'work_id' => $work->id,
                'user_id' => 1,
                'message' => $message_text
            ]);

            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' готов начать работу' . ', проект —' . $work->project->product_name);
        } else {
            Notification::create([
                'user_id' => $work->getPartnerUser($user->role)->id,
                'type' => 'Согласование проекта',
                'text' => $user->name . ' готов приступить к работе по проекту ' . $work->project->product_name,
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);

            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' готов приступить к работе по проекту ' . $work->project->product_name);
        }

        return response()->json()->setStatusCode(200);
    }

    public function createDeepLinkByWork(Work $work)
    {
        $user = Auth::user();
        $data = [
            'user_id' => $user->id,
            'work_id' => $work->id,
            'link' => Str::random(10),
            'destination' => $work->project->product_link,
        ];

        while (DeepLink::where("link", $data['link'])->first()) {
            $data['link'] = Str::random(10);
        }

        $deep_link = DeepLink::create($data);

        return $deep_link;
    }

    public function confirm(Work $work, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => '',
            'mark' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $user = Auth::user();
        $work->confirm($user);
        $work->save();

        if ($user->role == 'blogger') {
            $work->update(['last_message_at' => date('Y-m-d H:i')]);
            Message::create([
                'work_id' => $work->id,
                'user_id' => 1,
                'message' => 'Блогер запросил подтверждение проекта',
            ]);
            Notification::create([
                'user_id' => $work->seller->user->id,
                'type' => 'Подтверждение',
                'text' => 'Блогер отправил запрос на подтверждение выполнения проекта ' . $work->project->product_name,
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);
            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' отправил запрос на подтверждение выполнения проекта ' . $work->project->product_name);
        } else {
            $work->update(['last_message_at' => date('Y-m-d H:i')]);
            Message::create([
                'work_id' => $work->id,
                'user_id' => 1,
                'message' => 'Проект успешно завершён',
            ]);
            $work->status = Work::COMPLETED;
            $work->save();
            $work->project->isCompleted();
            Notification::create([
                'user_id' => $work->blogger->user->id,
                'type' => 'Подтверждение',
                'text' => 'Селлер подтвердил выполнение проекта ' . $work->project->product_name,
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);
            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' подтвердил выполнение проекта ' . $work->project->product_name);
        }

        return response()->json()->setStatusCode(200);
    }

    public function stats(Work $work, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'views' => 'numeric',
            'reposts' => 'numeric',
            'likes' => 'numeric',
            'platform_id' => 'numeric|exists:platforms,id|required',
            'images' => 'array',
            'images.*' => 'image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $user = Auth::user();
        $validated = $validator->validated();

        $work->update(['last_message_at' => date('Y-m-d H:i')]);
        $message = Message::create([
            'work_id' => $work->id,
            'user_id' => 1,
            'message' => 'Блогер прикрепил статистику к проекту ' . ($work->project->product_name ?? 'Проект удалён')
        ]);

        FinishStats::create([
            'subs' => 0,
            'platform' => $validated['platform_id'],
            'views' => $validated['views'] ?? 0,
            'reposts' => $validated['reposts'] ?? 0,
            'likes' => $validated['likes'] ?? 0,
            'work_id' => $work->id,
            'message_id' => $message->id
        ]);

        Notification::create([
            'user_id' => $work->seller->user->id,
            'type' => 'Статистика по проекту',
            'text' => $user->name . ' прикрепил статистику к проекту ' . ($work->project->product_name ?? 'Проект удалён'),
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' прикрепил статистику к проекту ' . ($work->project->product_name ?? 'Проект удалён'));

        if ($request->file('images')) {
            foreach ($request->file('images') as $image) {
                $image_path = $image->store('messages', 'public');
                MessageFile::create([
                    'source_id' => $message->id,
                    'type' => 0,
                    'link' => $image_path,
                ]);
            }
        }

        return response()->json()->setStatusCode(200);
    }

    public function deny(Work $work)
    {
        $work->delete();
        $user = Auth::user();

        Notification::create([
            'user_id' => $work->getPartnerUser($user->role)->id,
            'type' => 'Заявка отклонена',
            'text' => $user->name . ' отклонил вашу заявку на проект' . $work->project->product_name,
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' отклонил вашу заявку на проект' . $work->project->product_name);

        return response()->json()->setStatusCode(200);
    }

    public function cancel(Work $work)
    {
        $user = Auth::user();
        $role = $user->role;
        $work->update(['canceled_by_' . $role . '_at' => date('Y-m-d H:i')]);

        Message::create([
            'work_id' => $work->id,
            'user_id' => 1,
            'message' => $user->name . ' запросил отмену',
        ]);

        Notification::create([
            'user_id' => $work->getPartnerUser($user->role)->id,
            'type' => 'Отмена',
            'text' => $user->name . ' хочет отменить работы по проекту' . $work->project->product_name,
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' хочет отменить работы по проекту' . $work->project->product_name);

        if (!empty($work->canceled_by_blogger_at) && !empty($work->canceled_by_seller_at)) {
            $project_work = $work->projectWork;
            $seller_tariff = $user->getActiveTariffs($project_work->type);
            if ($seller_tariff && $seller_tariff->quantity >= 0) {
                $seller_tariff->update(['quantity' => $seller_tariff->quantity + 1]);
            }

            $work->update(['status' => Work::CANCELED]);
            $message_text = 'Статус работы изменён на: <span style="color: var(--primary)">отменена</span>';
            Message::create([
                'work_id' => $work->id,
                'user_id' => 1,
                'message' => $message_text,
            ]);
            Notification::create([
                'user_id' => $work->getPartnerUser($user->role)->id,
                'type' => 'Отмена',
                'text' => 'Работы по проекту' . $work->project->product_name . ' отменены',
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);
            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' отклонил вашу заявку на проект' . $work->project->product_name);
        }
    }

    public function viewChat(Work $work)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('profile');
        }
        $user_id = $work->seller_id;
        return view('shared.admin.chat', compact('work', 'user_id'));
    }
}
