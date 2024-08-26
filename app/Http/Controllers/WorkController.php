<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WorkController extends Controller
{
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

        if ($user->role == 'blogger') {
            if ($project_work->project->isSended()) {
                return response()->json('заявка отправлена')->setStatusCode(400);
            }
            $blogger_user = $user;
        } else {
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

        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, 'Вам поступила новая заявка от ' . $user->name  . ' на проект ' . $project_work->project->product_name);
        return response()->json(['success'], 200);
    }

    public function start($work_id)
    {
        $work = Work::find($work_id);
        $user = Auth::user();

        if (!$work->status && $work->created_by != $user->id) {
            $work->status = Work::PENDING;
            $work->last_message_at = date('Y-m-d H:i');
            $work->save();

            Notification::create([
                'user_id' => $work->getPartnerUser($user->role)->id,
                'type' => 'Новая заявка',
                'text' => $user->name . ' принял вашу заявку на проект ' . $work->project->product_name,
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);

            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' принял вашу заявку' . ' на проект ' . $work->project->product_name);
            return response()->json('success', 200);

        }

        return response()->json('error', 400);
    }

    public function acceptApplication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        $user = Auth::user();
        $work = Work::find($validated['work_id']);

        $work->update(['status' => Work::PENDING]);
        $partner_user = $work->getPartnerUser($user->role);
        Notification::create([
            'user_id' => $partner_user->id,
            'type' => 'Подтверждение',
            'text' => $partner_user->name . ' принял вашу заявку по проекту ' . $work->project->product_name,
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' принял вашу заявку по проекту ' . $work->project->product_name);
    }

    public function accept($work_id)
    {
        $work = Work::find($work_id);
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

        return response()->json('success', 200);
    }

    public function createDeepLinkByWork($work)
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

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => '',
            'mark' => 'numeric',
            'work_id' => 'required|exists:works,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $work = Work::find($request->work_id);
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
            Notification::create([
                'user_id' => $work->blogger->user->id,
                'type' => 'Подтверждение',
                'text' => 'Селлер подтвердил выполнение проекта ' . $work->project->product_name,
                'work_id' => $work->id,
                'from_user_id' => $user->id,
            ]);
            TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' подтвердил выполнение проекта ' . $work->project->product_name);
        }

        return redirect()->route('profile')->with('success');
    }

    public function stats(Work $work, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'views' => 'numeric',
            'reposts' => 'numeric',
            'likes' => 'numeric',
            'platform' => 'string|nullable',
            'images' => 'array',
            'images.*' => 'image',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $validated = $validator->validated();

        $work->update(['last_message_at' => date('Y-m-d H:i')]);
        $message = Message::create([
            'work_id' => $work->id,
            'user_id' => 1,
            'message' => 'Блогер прикрепил статистику к проекту ' . $work->project->product_name
        ]);

        FinishStats::create([
            'subs' => 0,
            'platform' => $validated['platform'],
            'views' => $validated['views'],
            'reposts' => $validated['reposts'],
            'likes' => $validated['likes'],
            'work_id' => $work->id,
            'message_id' => $message->id
        ]);

        Notification::create([
            'user_id' => $work->seller->user->id,
            'type' => 'Статистика по проекту',
            'text' => $user->name . ' прикрепил статистику к проекту ' . $work->project->product_name,
            'work_id' => $work->id,
            'from_user_id' => $user->id,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' прикрепил статистику к проекту ' . $work->project->product_name);

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

        return response()->json('success', 200);
    }

    public function deny(Work $work) {
        $work->delete();
        $user = Auth::user();
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, $user->name . ' отклонил вашу заявку на проект' . $work->project->product_name);
        return response()->json('success', 200);
    }

    public function viewChat(Work $work) {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('profile');
        }
        $user_id = $work->seller_id;
        return view('shared.admin.chat', compact('work', 'user_id'));
    }
}
