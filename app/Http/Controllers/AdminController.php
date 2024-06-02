<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function index()
    {
    }

    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'desc' => 'string|nullable',
            'sex' => 'required|string',
            'is_achievement' => 'string',
            'gender_ratio' => 'required|numeric',
            'tg_subs' => 'numeric',
            'tg_cover' => 'numeric',
            'tg_er' => 'numeric',
            'tg_cpm' => 'numeric',
            'inst_subs' => 'numeric',
            'inst_cover' => 'numeric',
            'inst_er' => 'numeric',
            'inst_cpm' => 'numeric',
            'yt_subs' => 'numeric',
            'yt_cover' => 'numeric',
            'yt_er' => 'numeric',
            'yt_cpm' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $blogger = Blogger::create([
            'user_id' => $validated['user_id'],
            'description' => $validated['desc'] ?? null,
            'sex' => $validated['sex'],
            'gender_ratio' => $validated['gender_ratio'],
            'is_achievement' => $validated['is_achievement'] == 'on',
        ]);

        if ($validated['tg_subs']) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => Blogger::TELEGRAM,
                'subscriber_quantity' => $validated['tg_subs'],
                'coverage' => $validated['tg_cover'],
                'engagement_rate' => $validated['tg_er'],
                'cost_per_mille' => $validated['tg_cpm'],
            ]);
        }

        if ($validated['inst_subs']) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => Blogger::INSTAGRAM,
                'subscriber_quantity' => $validated['inst_subs'],
                'coverage' => $validated['inst_cover'],
                'engagement_rate' => $validated['inst_er'],
                'cost_per_mille' => $validated['inst_cpm'],
            ]);
        }

        if ($validated['yt_subs']) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => Blogger::YOUTUBE,
                'subscriber_quantity' => $validated['yt_subs'],
                'coverage' => $validated['yt_cover'],
                'engagement_rate' => $validated['yt_er'],
                'cost_per_mille' => $validated['yt_cpm'],
            ]);
        }

        $user = User::find($validated['user_id']);
        $user->status = 1;
        $user->save();

        return response()->json('success', 200);
    }

    public function deny()
    {
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

    public function moderation(Request $request)
    {
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

    public function bloggers(Request $request)
    {
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

    public function sellers(Request $request)
    {
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

    public function achievement()
    {
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
