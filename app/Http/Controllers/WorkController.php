<?php

namespace App\Http\Controllers;

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
        Work::create($validated);
        Notification::create([
            'user_id'=> $validated['blogger_id'],
            'type'=> 'Новая заявка',
            'text'=> 'Вам поступила новая заявка от ' . $seller->user->name,
        ]);
        return redirect()->route('profile')->with('success', 'Заявка успешно отправлена');
    }

    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
        ]);

        if ($validator->fails()) {
            // return redirect()->route('profile')->withErrors($validator);
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $work = Work::find($validated['work_id']);
        $work->status = 1;
        $work->save();

        return redirect()->route('profile')->with('success', 'Заявка успешно принята');
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_id' => 'required|exists:works,id',
        ]);

        if ($validator->fails()) {
            // return redirect()->route('profile')->withErrors($validator);
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }
        $validated = $validator->validated();

        $work = Work::find($validated['work_id']);
        if ($user->role == 'blogger') {
            $work->confirmed_by_blogger_at = date('Y-m-d');
            Notification::create([
                'user_id'=> $work->seller->user->id,
                'type'=> 'Подтверждение',
                'text'=> 'Блогер отправил запрос на подтверждение выполнения проекта ' . $work->project->project_name,
            ]);
        } else {
            Notification::create([
                'user_id'=> $work->blogger->user->id,
                'type'=> 'Подтверждение',
                'text'=> 'Селлер отправил запрос на подтверждение выполнения проекта ' . $work->project->project_name,
            ]);
            $work->confirmed_by_seller_at = date('Y-m-d');
        }
        $work->save();

        return redirect()->route('profile')->with('success');
    }
}
