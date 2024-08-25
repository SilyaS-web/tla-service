<?php

namespace App\Http\Controllers\API;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Http\Controllers\Controller;
use App\Services\TgService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class BloggerController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'statuses' => 'array|nullable',
            'statuses.*' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $bloggers = Blogger::where([]);
        if (isset($validated['statuses'])) {
            $bloggers->whereHas('user', function (Builder $query) use ($validated) {
                $query->whereIn('status', array_values($validated['statuses']));
            });
        }

        $bloggers = $bloggers->with('user')->with('platforms')->with('themes')->with('country')->get();
        foreach ($bloggers as &$blogger) {
            foreach ($blogger->platforms as &$blogger_platform) {
                $blogger_platform->platform;
            }

            foreach ($blogger->themes as &$theme) {
                $theme->theme;
            }
        }
        $data = [
            'bloggers' => $bloggers,
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function show(Blogger $blogger)
    {
        $blogger->with('user')
            ->with('platforms')
            ->with('themes')
            ->with('country')
            ->get();


        foreach ($blogger->platforms as &$blogger_platform) {
            $blogger_platform->platform;
        }

        foreach ($blogger->themes as &$theme) {
            $theme->theme;
        }

        $data = [
            'blogger' => $blogger,
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return  response()->json($data)->setStatusCode(200);
    }

    public function accept(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blogger_id' => 'required|numeric',
            'desc' => 'string|nullable',
            'sex' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'city' => 'string|nullable',
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

        if (
            (!isset($validated['telegram_link']) || empty($validated['telegram_link'])) &&
            (!isset($validated['instagram_link']) || empty($validated['instagram_link'])) &&
            (!isset($validated['youtube_link']) || empty($validated['youtube_link'])) &&
            (!isset($validated['vk_link']) || empty($validated['vk_link']))
        ) {
            return response()->json(['message' => 'Укажите хотя бы одну соц сеть'], 400);
        }

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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogger $blogger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogger $blogger)
    {
        //
    }
}
