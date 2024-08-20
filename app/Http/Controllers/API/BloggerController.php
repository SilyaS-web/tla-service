<?php

namespace App\Http\Controllers\API;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Http\Controllers\Controller;
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
                $query->whereIn('status', $validated['statuses']);
                dd($query);
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

    public function accept(Blogger $blogger, Request $request)
    {
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
