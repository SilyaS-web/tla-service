<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function index() {

    }

    public function acceptBlogger() {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required|numeric',
            'platform' => ['required', Rule::in(Blogger::PLATFORM_TYPES)],
            'description' => 'required|string',
            'subscriber_quantity' => 'required|numeric',
            'coverage' => 'required|numeric',
            'engagement_rate' => 'required|numeric',
            'cost_per_mille' => 'required|numeric',
            'gender_ratio' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->with('success', 'Ошибка при подтверждении блогера!');
        }

        $validated = $validator->validated();
        Blogger::create([
            'user_id' => $validated['user_id'],
            'platform' => $validated['platform'],
            'description' => $validated['description'],
            'subscriber_quantity' => $validated['subscriber_quantity'],
            'coverage' => $validated['coverage'],
            'engagement_rate' => $validated['engagement_rate'],
            'cost_per_mille' => $validated['cost_per_mille'],
            'gender_ratio' => $validated['gender_ratio'],
        ]);

        $user = User::find($validated['user_id']);
        $user->status = 1;
        $user->save();

        return redirect()->route('profile')->with('success', 'Блогер успешно подтверждён!');
    }

    public function denyBlogger() {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->with('success', 'Не удалось отклонить заявку!');
        }

        $validated = $validator->validated();
        $user = User::find($validated['user_id']);
        $user->status = -1;
        $user->save();

        return redirect()->route('profile')->with('success', 'Заявка отклонена!');
    }

    public function ban(Request $request) {
    }
}
