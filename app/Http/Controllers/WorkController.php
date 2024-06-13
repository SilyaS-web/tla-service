<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\DeepLink;
use App\Models\Message;
use App\Models\Notification;
use App\Models\ProjectWork;
use App\Models\Work;
use App\Models\User;
use App\Services\TgService;
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

        if ($user->role == 'seller') {
            $seller = $user->seller;
            if ($seller) {
                if ($seller->remaining_tariff < 1) {
                    return response()->json(['extend tariff', $seller->remaining_tariff], 400);
                }
            } else {
                return response()->json(['seller not found'], 400);
            }

            $seller->remaining_tariff -= 1;
            $seller->save();
        }
        if ($user->role == 'blogger') {
            $blogger_user = $user;
        } else {
            $blogger_user = Blogger::find($validated['blogger_id']);
        }

        $project_work = ProjectWork::find($validated['project_work_id']);
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
            'user_id' => $work->getPartnerUser($user)->id,
            'type' => 'Новая заявка',
            'text' => 'Вам поступила новая заявка от ' . $user->name,
        ]);

        TgService::notify($work->getPartnerUser($user)->tgPhone->chat_id, 'Вам поступила новая заявка от ' . $user->name);
        return response()->json(['success'], 200);
    }

    public function start($work_id)
    {
        $work = Work::find($work_id);
        $user = Auth::user();

        if (!$work->status && $work->created_by != $user->id) {
            $work->status = Work::PENDING;
            $work->save();
            TgService::notify($work->getPartnerUser($user)->tgPhone->chat_id, $user->name . ' принял вашу заявку');
            return redirect()->back()->with('success', 'Заявка успешно принята');
        }

        return redirect()->back()->with('success', 'Не удалось принять заявку');
    }

    public function accept($work_id)
    {
        $work = Work::find($work_id);
        $user = Auth::user();
        $work->accept($user);
        Message::create([
            'work_id' => $work->id,
            'user_id' => 0,
            'message' => $user->name . ' готов приступить к работе',
        ]);


        if ($work->isBothAcceptd() && $work->status = Work::PENDING) {
            $work->status = Work::IN_PROGRESS;
            $work->save();
            $deeplink = $this->createDeepLinkByWork($work);
            $link = request()->getSchemeAndHttpHost() . '/lnk/' . $deeplink->link;
            Message::create([
                'work_id' => $work->id,
                'user_id' => 0,
                'message' => 'Работа начата - ссылка для сбора статистики <a target="_blank" href="' . $link . '">' . $link . '</a>',
            ]);
            TgService::notify($work->getPartnerUser($user)->tgPhone->chat_id, $user->name . ' готов приступить к работе');
        } else {
            TgService::notify($work->getPartnerUser($user)->tgPhone->chat_id, $user->name . ' готов приступить к работе');
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
            Message::create([
                'work_id' => $work->id,
                'user_id' => 0,
                'message' => 'Блогер запросил подтверждение проекта',
            ]);
            Notification::create([
                'user_id' => $work->seller->user->id,
                'type' => 'Подтверждение',
                'text' => 'Блогер отправил запрос на подтверждение выполнения проекта ' . $work->project->product_name,
            ]);
            TgService::notify($work->getPartnerUser($user)->tgPhone->chat_id, 'Блогер отправил запрос на подтверждение выполнения проекта ' . $work->project->product_name);
        } else {
            Message::create([
                'work_id' => $work->id,
                'user_id' => 0,
                'message' => 'Проект успешно завершён',
            ]);
            $work->status = Work::COMPLETED;
            $work->save();
            Notification::create([
                'user_id' => $work->blogger->user->id,
                'type' => 'Подтверждение',
                'text' => 'Селлер подтвердил выполнение проекта ' . $work->project->product_name,
            ]);
            TgService::notify($work->getPartnerUser($user)->tgPhone->chat_id, 'Селлер подтвердил выполнение проекта ' . $work->project->product_name);
        }

        return redirect()->route('profile')->with('success');
    }
}
