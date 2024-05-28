<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\Seller;
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

    public function accept() {
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
            return response()->json($validator->errors(), 400);
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

        return view('shared.admin.bloggers-list');
    }

    public function deny() {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $user = User::find($validated['user_id']);
        $user->status = -1;
        $user->save();

        return view('shared.admin.bloggers-list');
    }

    public function moderation(Request $request) {
        $validator = Validator::make(request()->all(), [
            'name' => 'string',
        ]);

        if ($validator->fails()) {
            return [];
        }

        $validated = $validator->validated();

        $filter = [
            ['role', 'blogger'],
            ['status', 0],
        ];

        if (!empty($validated['name'])) {
            $filter[] = ['name', 'like', '%' . $validated['name'] . '%'];
        }

        $unverified_users = User::where($filter)->get();

        return view('shared.admin.unverified-users-list', compact('unverified_users'));
    }

    public function bloggers(Request $request) {
        $validator = Validator::make(request()->all(), [
            'name' => 'string',
        ]);

        if ($validator->fails()) {
            return [];
        }
        $validated = $validator->validated();


        $bloggers = [];
        if (!empty($validated['name'])) {
            $bloggers = Blogger::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['name'] . '%');
            })->get();
        } else {
            $bloggers = Blogger::get();
        }

        return view('shared.admin.bloggers-list', compact('bloggers'));
    }

    public function sellers(Request $request) {
        $validator = Validator::make(request()->all(), [
            'name' => 'string',
        ]);

        if ($validator->fails()) {
            $sellers = [];
            return view('shared.admin.sellers-list', compact('sellers'));

        }
        $validated = $validator->validated();

        $sellers = [];
        if (!empty($validated['name'])) {
            $sellers = Seller::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['name'] . '%');
            })->get();
        } else {
            $sellers = Seller::get();
        }

        return view('shared.admin.sellers-list', compact('sellers'));
    }

    public function achievement() {
        $validator = Validator::make(request()->all(), [
            'user_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $user = User::find($validated['user_id']);
        if ($user->role == 'seller') {
            $user->seller->is_achievement = 1;
        } else {
            $user->blogger->is_achievement = 1;
        }

        $user->save();

        return response()->json('success', 200);
    }
}
