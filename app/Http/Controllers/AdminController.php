<?php

namespace App\Http\Controllers;

use App\Models\BloggerPlatform;
use App\Models\Country;
use App\Models\Platform;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function editBlogger(User $user)
    {
        $countries = Country::get();
        $themes = Theme::get();
        $platforms = Platform::get();
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
            'platforms' => 'array',
            'platforms.*.link' => 'string|nullable',
            'platforms.*.subscriber_quantity' => 'numeric|nullable',
            'platforms.*.coverage' => 'numeric|nullable',
            'platforms.*.engagement_rate' => 'numeric|nullable',
            'platforms.*.cost_per_mille' => 'numeric|nullable',
            'platforms.*.additional_coverage' => 'numeric|nullable',
            'platforms.*.additional_engagement_rate' => 'numeric|nullable',
            'platforms.*.platform_id' => 'numeric|exists:platforms,id',
            'is_achievement' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $is_platform = false;

        foreach ($validated['platforms'] as $platform) {
            if (isset($validated['telegram_link']) && !empty($validated['telegram_link'])) {
                $is_platform = true;
                break;
            }
        }
        if ($is_platform) {
            return response()->json(['message' => 'Укажите хотя бы одну соц сеть'], 400);
        }

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

        foreach ($validated['platforms'] as $blogger_platform) {
            if (empty($blogger_platform) || empty($blogger_platform['platform_id'])) {
                continue;
            }

            $platform = $blogger->platforms()->where('platform_id', $blogger_platform['platform_id'])->first();
            if (isset($blogger_platform['link']) && !empty($blogger_platform['link'])) {
                if ($platform) {
                    $platform->update([
                        'link' => $blogger_platform['link'] ?? null,
                        'subscriber_quantity' => $blogger_platform['subscriber_quantity'] ?? null,
                        'coverage' => $blogger_platform['coverage'] ?? null,
                        'additional_coverage' => $blogger_platform['additional_coverage'] ?? null,
                        'engagement_rate' => $blogger_platform['engagement_rate'] ?? null,
                        'additional_engagement_rate' => $blogger_platform['additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $blogger_platform['cost_per_mille'] ?? null,
                    ]);
                } else {
                    BloggerPlatform::create([
                        'blogger_id' => $blogger->id,
                        'platform_id' => $blogger_platform['platform_id'],
                        'link' => $blogger_platform['link'] ?? null,
                        'subscriber_quantity' => $blogger_platform['subscriber_quantity'] ?? null,
                        'coverage' => $blogger_platform['coverage'] ?? null,
                        'additional_coverage' => $blogger_platform['additional_coverage'] ?? null,
                        'engagement_rate' => $blogger_platform['engagement_rate'] ?? null,
                        'additional_engagement_rate' => $blogger_platform['additional_engagement_rate'] ?? null,
                        'cost_per_mille' => $blogger_platform['cost_per_mille'] ?? null,
                    ]);
                }
            } elseif ((!isset($blogger_platform['link']) || empty($blogger_platform['link'])) && $platform) {
                $platform->delete();
            }
        }

        return redirect()->back()->with('success', 'Данные успешно обновлены');
    }
}
