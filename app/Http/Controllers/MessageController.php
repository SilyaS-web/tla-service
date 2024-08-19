<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageFile;
use App\Models\Notification;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\User;
use App\Models\Work;
use App\Services\TgService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id|nullable',
            'work_id' => 'exists:works,id|nullable',
            'new_only' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }
        $validated = $validator->validated();
        $user_id = $user->id;
        $role = $user->role;
        $filter = [
            $role . '_id' => $user_id,
        ];

        if (!empty($validated['work_id'])) {
            $filter['id'] = $validated['work_id'];
        }

        $works = Work::where($filter)->where('status', '<>', null)->orderBy('last_message_at', 'desc')->get();
        if (!empty($validated['work_id'])) {
            $work = $works->first();
            $btn_class = 'accept-btn';
            $btn_text = 'Начать работу';
            $data_id = $work->id;
            $is_completed = false;
            $lost = $work->projectWork->quantity - Work::where('project_work_id', $work->projectWork->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
            if (($work->status == Work::PENDING || $work->status == null) && $lost < 1){
                $btn_class = 'tariff-btn';
                $btn_text = 'Все доступные места на интеграцию уже заняты';
            } else if ($work->status == Work::PENDING) {
                if ($work->isAcceptedByUser($user)) {
                    $btn_text = 'Ожидаем ответа от ' . $work->getPartnerUser($user->role)->name;
                    $btn_class = 'btn-chat-action disabled';
                }
            } else if ($work->status == Work::IN_PROGRESS) {
                if ($work->projectWork->type !== Project::FEEDBACK && !$work->FinishStats) {
                    if ($user->role == 'blogger') {
                        $btn_class = 'send-stats-blogger-btn';
                        $btn_text = 'Прикрепить статистику';
                    } else {
                        $btn_class = 'btn-chat-action disabled';
                        $btn_text = 'Ожидаем статистику от блогера';
                    }
                } else if ($work->isConfirmedByUser($user)) {
                    $btn_class = 'btn-chat-action disabled';
                    $btn_text =  'Ожидаем ответа от ' . $work->getPartnerUser($user->role)->name;
                } else {
                    $btn_class = 'confirm-completion-btn';
                    $btn_text = 'Завершить проект';
                }
            } else if ($work->status == Work::COMPLETED) {
                $btn_class = 'btn-chat-action disabled';
                $btn_text =  'Проект завершён';
                $is_completed = true;
            }

            $is_new = false;
            if (Message::where('work_id', $validated['work_id'])->where('viewed_at', null)->count() > 0) {
                $is_new = true;
            }
            Message::where('work_id', $validated['work_id'])->where('viewed_at', null)->where('user_id', '<>', $user->id)->update(['viewed_at' => date('Y-m-d H:i')]);
            return response()->json(['view' => view('shared.chat.messages', compact('work', 'user_id', 'role'))->render(), 'btn-class' => $btn_class, 'btn-text' => $btn_text, 'data-id' => $data_id, 'is_new' => $is_new, 'is_completed' => $is_completed]);
        }
        $works_count = $works->count();
        return response()->json(['view' => view('shared.chat.chat-list', compact('works', 'user_id', 'role'))->render(), 'count' => $works_count]);
    }

    public function count(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'exists:users,id|nullable',
            'work_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $user = Auth::user();
        if (!$user) {
            $user = User::find($validated['user_id']);
        }

        $user_id = $user->id;
        $messages = Message::where([
            ['work_id', $validated['work_id']],
            ['user_id', '<>', $user_id]
        ]);

        return response()->json($validator->errors(), 400);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
            'user_id' => 'exists:users,id|nullable',
            'message' => 'required|string',
            'img' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        $validated = $validator->validated();
        $validated['user_id'] = $user->id;

        $message = Message::create($validated);
        if ($request->file('img')) {
            $product_image = $request->file('img');
            $image_path = $product_image->store('messages', 'public');
            MessageFile::create([
                'source_id' => $message->id,
                'type' => 0,
                'link' => $image_path,
            ]);
        }

        $work = Work::find($validated['work_id']);
        $work->update(['last_message_at' => date('Y-m-d H:i')]);
        Notification::create([
            'user_id' => $work->getPartnerUser($user->role)->id,
            'work_id' => $work->id,
            'type' => 'Новое сообщение',
            'text' => 'Вам поступило новое сообщение от ' . $user->name,
        ]);
        TgService::notify($work->getPartnerUser($user->role)->tgPhone->chat_id, 'Вам поступило новое сообщение от ' . $user->name);

        return response()->json(['message' => 'success'], 200);
    }

    public function workViewed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
            'user_id' => 'exists:users,id|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        Message::whereIn('work_id', $validated['work_id'])->where('created_at', '<=', time())->update(['viewed_at' => time()]);
        return response()->json(['message' => 'success'], 200);
    }
}
