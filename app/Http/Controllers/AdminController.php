<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Country;
use App\Models\Seller;
use App\Models\Theme;
use App\Models\User;
use App\Services\TgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

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
            'telegram_link' => 'string|nullable',
            'telegram_subs' => 'numeric|nullable',
            'telegram_cover' => 'numeric|nullable',
            'telegram_additional_coverage' => 'numeric|nullable',
            'telegram_er' => 'numeric|nullable',
            'telegram_additional_engagement_rate' => 'numeric|nullable',
            'telegram_cpm' => 'numeric|nullable',
            'instagram_link' => 'string|nullable',
            'instagram_subs' => 'numeric|nullable',
            'instagram_cover' => 'numeric|nullable',
            'instagram_additional_coverage' => 'numeric|nullable',
            'instagram_er' => 'numeric|nullable',
            'instagram_additional_engagement_rate' => 'numeric|nullable',
            'instagram_cpm' => 'numeric|nullable',
            'youtube_link' => 'string|nullable',
            'youtube_subs' => 'numeric|nullable',
            'youtube_cover' => 'numeric|nullable',
            'youtube_additional_coverage' => 'numeric|nullable',
            'youtube_er' => 'numeric|nullable',
            'youtube_additional_engagement_rate' => 'numeric|nullable',
            'youtube_cpm' => 'numeric|nullable',
            'vk_link' => 'string|nullable',
            'vk_subs' => 'numeric|nullable',
            'vk_cover' => 'numeric|nullable',
            'vk_additional_coverage' => 'numeric|nullable',
            'vk_er' => 'numeric|nullable',
            'vk_additional_engagement_rate' => 'numeric|nullable',
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
            'is_achievement' => isset($validated['is_achievement']),
        ]);

        foreach (BloggerPlatform::getLowerPlatforms() as $platform_type) {
            $platform = $blogger->platforms()->where('name', $platform_type)->first();
            if (isset($validated[$platform_type . '_link']) && !empty($validated[$platform_type . '_link'])) {
                if ($platform) {
                    $platform->update([
                        'blogger_id' => $blogger->id,
                        'name' => $platform_type,
                        'link' => $validated[$platform_type . '_link'] ?? null,
                        'subscriber_quantity' => $validated[$platform_type . '_subs'] ?? null,
                        'coverage' => $validated[$platform_type . '_cover'] ?? null,
                        'additional_coverage' => $validated[$platform_type . '_additional_coverage'] ?? null,
                        'engagement_rate' => $validated[$platform_type . '_er'] ?? null,
                        'additional_engagement_rate' => $validated[$platform_type . '_additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $validated[$platform_type . '_cpm'] ?? null,
                    ]);
                } else {
                    BloggerPlatform::create([
                        'blogger_id' => $blogger->id,
                        'name' => $platform_type,
                        'link' => $validated[$platform_type . '_link'] ?? null,
                        'subscriber_quantity' => $validated[$platform_type . '_subs'] ?? null,
                        'coverage' => $validated[$platform_type . '_cover'] ?? null,
                        'additional_coverage' => $validated[$platform_type . '_additional_coverage'] ?? null,
                        'engagement_rate' => $validated[$platform_type . '_er'] ?? null,
                        'additional_engagement_rate' => $validated[$platform_type . '_additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $validated[$platform_type . '_cpm'] ?? null,
                    ]);
                }
            } elseif ((!isset($validated[$platform_type . '_link']) || empty($validated[$platform_type . '_link'])) && $platform) {
                $platform->delete();
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

    public function editBlogger(User $user)
    {
        $countries = Country::get();
        $themes = Theme::get();
        $platforms = BloggerPlatform::PLATFORM_TYPES;
        return view('admin.edit-blogger', compact('user', 'countries', 'platforms'));
    }

    public function updateBlogger(User $user)
    {
        $validator = Validator::make(request()->all(), [
            'image' => 'image|nullable',
            'name' => 'required|string',
            'email' => 'required|email',
            'country_id' => 'required|exists:countries,id',
            'city' => 'string|nullable',
            'description' => 'string|nullable',
            'gender_ratio' => 'required|numeric',
            'sex' => 'required|string',
            'telegram_link' => 'string|nullable',
            'telegram_subs' => 'numeric|nullable',
            'telegram_cover' => 'numeric|nullable',
            'telegram_additional_coverage' => 'numeric|nullable',
            'telegram_er' => 'numeric|nullable',
            'telegram_additional_engagement_rate' => 'numeric|nullable',
            'telegram_cpm' => 'numeric|nullable',
            'instagram_link' => 'string|nullable',
            'instagram_subs' => 'numeric|nullable',
            'instagram_cover' => 'numeric|nullable',
            'instagram_additional_coverage' => 'numeric|nullable',
            'instagram_er' => 'numeric|nullable',
            'instagram_additional_engagement_rate' => 'numeric|nullable',
            'instagram_cpm' => 'numeric|nullable',
            'youtube_link' => 'string|nullable',
            'youtube_subs' => 'numeric|nullable',
            'youtube_cover' => 'numeric|nullable',
            'youtube_additional_coverage' => 'numeric|nullable',
            'youtube_er' => 'numeric|nullable',
            'youtube_additional_engagement_rate' => 'numeric|nullable',
            'youtube_cpm' => 'numeric|nullable',
            'vk_link' => 'string|nullable',
            'vk_subs' => 'numeric|nullable',
            'vk_cover' => 'numeric|nullable',
            'vk_additional_coverage' => 'numeric|nullable',
            'vk_er' => 'numeric|nullable',
            'vk_additional_engagement_rate' => 'numeric|nullable',
            'vk_cpm' => 'numeric|nullable',
            'is_achievement' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (request()->file('image')) {
            if (Storage::exists($user->getImageURL())) {
                Storage::delete($user->getImageURL());
            }

            $product_image = request()->file('image');
            $image_path = $product_image->store('profile', 'public');
            $user->image = $image_path;
        }

        $user->save();
        $blogger = $user->blogger;

        $blogger->update([
            'city' => $validated['city'] ?? null,
            'description' => $validated['description'] ?? '',
            'sex' => $validated['sex'] ?? 'male',
            'country_id' => $validated['country_id'],
            'gender_ratio' => $validated['gender_ratio'] ?? 0,
            'is_achievement' => isset($validated['is_achievement']),
        ]);
        foreach (BloggerPlatform::getLowerPlatforms() as $platform_type) {
            $platform = $blogger->platforms()->where('name', $platform_type)->first();
            if (isset($validated[$platform_type . '_link']) && !empty($validated[$platform_type . '_link'])) {
                if ($platform) {
                    $platform->update([
                        'blogger_id' => $blogger->id,
                        'name' => $platform_type,
                        'link' => $validated[$platform_type . '_link'] ?? null,
                        'subscriber_quantity' => $validated[$platform_type . '_subs'] ?? null,
                        'coverage' => $validated[$platform_type . '_cover'] ?? null,
                        'additional_coverage' => $validated[$platform_type . '_additional_coverage'] ?? null,
                        'engagement_rate' => $validated[$platform_type . '_er'] ?? null,
                        'additional_engagement_rate' => $validated[$platform_type . '_additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $validated[$platform_type . '_cpm'] ?? null,
                    ]);
                } else {
                    BloggerPlatform::create([
                        'blogger_id' => $blogger->id,
                        'name' => $platform_type,
                        'link' => $validated[$platform_type . '_link'] ?? null,
                        'subscriber_quantity' => $validated[$platform_type . '_subs'] ?? null,
                        'coverage' => $validated[$platform_type . '_cover'] ?? null,
                        'additional_coverage' => $validated[$platform_type . '_additional_coverage'] ?? null,
                        'engagement_rate' => $validated[$platform_type . '_er'] ?? null,
                        'additional_engagement_rate' => $validated[$platform_type . '_additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $validated[$platform_type . '_cpm'] ?? null,
                    ]);
                }
            } elseif ((!isset($validated[$platform_type . '_link']) || empty($validated[$platform_type . '_link'])) && $platform) {
                $platform->delete();
            }
        }

        return redirect()->back()->with('success', 'Данные успешно обновлены');
    }
}
