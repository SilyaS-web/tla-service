<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\Work;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blogger_id' => 'exists:users,id|nullable',
            'seller_id' => 'exists:users,id|nullable',
            'project_id' => 'required|exists:projects,id',
        ]);

        if ($validator->fails()) {
            // return redirect()->route('profile')->withErrors($validator);
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();
        // $seller = User::find($validated['seller_id'])->seller;
        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }
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
        $validated['seller_id'] = $seller->id;
        $validated['status'] = Work::PENDING;

        Work::create($validated);
        Notification::create([
            'user_id' => $validated['blogger_id'],
            'type' => 'Новая заявка',
            'text' => 'Вам поступила новая заявка от ' . $seller->user->name,
        ]);
        return redirect()->route('profile')->with('success', 'Заявка успешно отправлена');
    }

    public function accept($work_id)
    {
        $work = Work::find($work_id);
        $user = Auth::user();
        $param = 'accepted_by_' . $user->role . '_at';
        $work->$param = date('Y-m-d H:i');
        $work->save();
        Message::create([
            'work_id' => $work->id,
            'user_id' => 0,
            'message' => $user->role . ' готов приступить к работе',
        ]);
        if ($work->isBothAcceptd() && $work->status = Work::PENDING) {
            $work->status = Work::IN_PROGRESS;
            $work->save();
            Message::create([
                'work_id' => $work->id,
                'user_id' => 0,
                'message' => 'Работа начата',
            ]);
        }

        return response()->json('success', 200);
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
                'text' => 'Блогер отправил запрос на подтверждение выполнения проекта ' . $work->project->project_name,
            ]);
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
                'text' => 'Селлер подтвердил выполнение проекта ' . $work->project->project_name,
            ]);
        }

        return redirect()->route('profile')->with('success');
    }
}
