<?php

namespace App\Http\Controllers\API;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Http\Controllers\Controller;
use App\Http\Resources\BloggerResource;
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

        $data = [
            'bloggers' => BloggerResource::collection($bloggers->get()),
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function show(Blogger $blogger)
    {
        $data = [
            'blogger' => new BloggerResource($blogger),
            'platform_fields' => BloggerPlatform::getFields(),
        ];

        return  response()->json($data)->setStatusCode(200);
    }

    public function accept(Blogger $blogger, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'string|nullable',
            'is_achievement' => 'string|nullable',
            'country_id' => 'required|exists:countries,id',
            'city' => 'string|nullable',
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
            'platforms.*.platform_id' => 'numeric|exist:platforms,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
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

        $blogger = Blogger::find($validated['blogger_id']);

        $blogger->update([
            'description' => $validated['description'] ?? null,
            'is_achievement' => isset($validated['is_achievement']),
            'country_id' => $validated['country_id'],
            'city' => isset($validated['city']),
            'gender_ratio' => $validated['gender_ratio'],
            'sex' => $validated['sex'],
        ]);

        foreach ($validated['platforms'] as $platform) {
            $platform = $blogger->platforms()->where('platform_id', $platform->id)->first();
            if (isset($platform['link']) && !empty($platform['link'])) {
                    $platform->updateOrInsert($platform);
            } elseif ((!isset($platform['link']) || empty($platform['link'])) && $platform) {
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
