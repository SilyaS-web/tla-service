<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Seller;
use App\Models\User;
use App\Services\TgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class AdminController extends Controller
{
    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blogger_id' => 'required|numeric',
            'desc' => 'string|nullable',
            'sex' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            // 'city' => 'required|string',
            'is_achievement' => 'string|nullable',
            'gender_ratio' => 'required|numeric',
            'tg_link' => 'string|nullable',
            'tg_subs' => 'numeric|nullable',
            'tg_cover' => 'numeric|nullable',
            'tg_er' => 'numeric|nullable',
            'tg_cpm' => 'numeric|nullable',
            'inst_link' => 'string|nullable',
            'inst_subs' => 'numeric|nullable',
            'inst_cover' => 'numeric|nullable',
            'inst_er' => 'numeric|nullable',
            'inst_cpm' => 'numeric|nullable',
            'yt_link' => 'string|nullable',
            'yt_subs' => 'numeric|nullable',
            'yt_cover' => 'numeric|nullable',
            'yt_er' => 'numeric|nullable',
            'yt_cpm' => 'numeric|nullable',
            'vk_link' => 'string|nullable',
            'vk_subs' => 'numeric|nullable',
            'vk_cover' => 'numeric|nullable',
            'vk_er' => 'numeric|nullable',
            'vk_cpm' => 'numeric|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $blogger = Blogger::find($validated['blogger_id']);

        $blogger->update([
            'description' => $validated['desc'] ?? null,
            'sex' => $validated['sex'],
            'country_id' => $validated['country_id'],
            'gender_ratio' => $validated['gender_ratio'],
            'is_achievement' => $validated['is_achievement'] ?? 0,
        ]);

        if ($validated['tg_subs']) {
            $tg_platform = $blogger->platforms()->where('name', BloggerPlatform::TELEGRAM)->first();
            if ($tg_platform) {
                $tg_platform->update([
                    'link' => $validated['tg_link'],
                    'subscriber_quantity' => $validated['tg_subs'],
                    'coverage' => $validated['tg_cover'],
                    'engagement_rate' => $validated['tg_er'],
                    'cost_per_mille' => $validated['tg_cpm'],
                ]);
            } else {
                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'link' => $validated['tg_link'],
                    'name' => BloggerPlatform::TELEGRAM,
                    'subscriber_quantity' => $validated['tg_subs'],
                    'coverage' => $validated['tg_cover'],
                    'engagement_rate' => $validated['tg_er'],
                    'cost_per_mille' => $validated['tg_cpm'],
                ]);
            }
        }

        if ($validated['inst_subs']) {
            $inst_platform = $blogger->platforms()->where('name', BloggerPlatform::INSTAGRAM)->first();
            if ($inst_platform) {
                $inst_platform->update([
                    'link' => $validated['inst_link'],
                    'subscriber_quantity' => $validated['inst_subs'],
                    'coverage' => $validated['inst_cover'],
                    'engagement_rate' => $validated['inst_er'],
                    'cost_per_mille' => $validated['inst_cpm'],
                ]);
            } else {
                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'name' => BloggerPlatform::INSTAGRAM,
                    'link' => $validated['inst_link'],
                    'subscriber_quantity' => $validated['inst_subs'],
                    'coverage' => $validated['inst_cover'],
                    'engagement_rate' => $validated['inst_er'],
                    'cost_per_mille' => $validated['inst_cpm'],
                ]);
            }
        }

        if ($validated['yt_subs']) {
            $yt_platform = $blogger->platforms()->where('name', BloggerPlatform::YOUTUBE)->first();
            if ($yt_platform) {
                $yt_platform->update([
                    'link' => $validated['yt_link'],
                    'subscriber_quantity' => $validated['yt_subs'],
                    'coverage' => $validated['yt_cover'],
                    'engagement_rate' => $validated['yt_er'],
                    'cost_per_mille' => $validated['yt_cpm'],
                ]);
            } else {
                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'name' => BloggerPlatform::YOUTUBE,
                    'subscriber_quantity' => $validated['yt_subs'],
                    'link' => $validated['yt_link'],
                    'coverage' => $validated['yt_cover'],
                    'engagement_rate' => $validated['yt_er'],
                    'cost_per_mille' => $validated['yt_cpm'],
                ]);
            }
        }

        if ($validated['vk_subs']) {
            $vk_platform = $blogger->platforms()->where('name', BloggerPlatform::VK)->first();
            if ($vk_platform) {
                $vk_platform->update([
                    'link' => $validated['vk_link'],
                    'subscriber_quantity' => $validated['vk_subs'],
                    'coverage' => $validated['vk_cover'],
                    'engagement_rate' => $validated['vk_er'],
                    'cost_per_mille' => $validated['vk_cpm'],
                ]);
            } else {
                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'name' => BloggerPlatform::VK,
                    'link' => $validated['vk_link'],
                    'subscriber_quantity' => $validated['vk_subs'],
                    'coverage' => $validated['vk_cover'],
                    'engagement_rate' => $validated['vk_er'],
                    'cost_per_mille' => $validated['vk_cpm'],
                ]);
            }
        }

        $user = $blogger->user;
        $user->status = 1;
        $user->save();

        TgService::notify($blogger->user->tgPhone->chat_id, 'Вы успешно прошли модерацию');

        return response()->json('success', 200);
    }

    public function deny(User $user)
    {
        $user->status = -1;
        $user->save();
        if ($user->status == 0) {
            TgService::notify($user->tgPhone->chat_id, 'Вы не прошли модерацию');
        } else {
            TgService::notify($user->tgPhone->chat_id, 'Вы были забанены');
        }

        return response()->json('success', 200);
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
            return response()->json('success', 200);

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

        return response()->json('success', 200);
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
