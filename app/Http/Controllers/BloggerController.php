<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\BloggerTheme;
use App\Models\Project;
use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class BloggerController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|nullable',
            'platform' => [Rule::in(BloggerPlatform::getLowerPlatforms()), 'nullable'],
            'subscriber_quantity_min' => 'numeric',
            'subscriber_quantity_max' => 'numeric',
            'city' => 'string|nullable',
            'country' => 'numeric|exists:countries,id|nullable',
            'sex' => 'string|nullable',
            'themes' => 'array|nullable',
            'themes.*' => 'numeric',
        ]);

        if ($validator->fails()) {
            $bloggers = [];
            return response()->json($validator->errors(), 400);
            return view('blogger.list', compact('bloggers'));
        }

        $validated = $validator->validated();

        $user = Auth::user();

        $bloggers = Blogger::where([]);

        if (!empty($validated['name']) && !empty($validated['name'])) {
            $bloggers = $bloggers->whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['name'] . '%');
            });
        }

        if (isset($validated['subscriber_quantity_min']) && !empty($validated['subscriber_quantity_min'])) {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('subscriber_quantity', '>=', $validated['subscriber_quantity_min']);
            });
        }

        if (isset($validated['subscriber_quantity_max']) && !empty($validated['subscriber_quantity_max'])) {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('subscriber_quantity', '>=', $validated['subscriber_quantity_max']);
            });
        }

        if (isset($validated['themes']) && !empty($validated['themes'])) {
            $bloggers->whereHas('themes', function (Builder $query) use ($validated) {
                $query->whereIn('theme_id', $validated['themes']);
            });
        }

        if (isset($validated['platform'])  && !empty($validated['platform'])) {
            $bloggers->whereHas('platforms', function (Builder $query) use ($validated) {
                $query->where('name', $validated['platform']);
            });
        }

        if (isset($validated['city'])  && !empty($validated['city'])) {
            $bloggers->where('city', $validated['city']);
        }

        if (isset($validated['country'])  && !empty($validated['country'])) {
            $bloggers->whereHas('country', function (Builder $query) use ($validated) {
                $query->where('id', $validated['country']);
            });
        }

        if (isset($validated['sex'])  && !empty($validated['sex'])) {
            $sex_array = explode(',', $validated['sex']);
            $bloggers->whereIn('sex', $sex_array);
        }

        $bloggers = $bloggers->get();
        return view("blogger.list", compact('bloggers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desc' => 'string|nullable',
            'sex' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|numeric',
            'tg-link' => 'string|nullable',
            'inst-link' => 'string|nullable',
            'yt-link' => 'string|nullable',
            'vk-link' => 'string|nullable',
            'themes' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $validated = $validator->validated();
        $blogger = Blogger::create([
            'user_id' => $user->id,
            'city' => $validated['city'],
            'country_id' => $validated['country'],
            'description' => $validated['desc'] ?? null,
            'sex' => $validated['sex'],
        ]);

        if (isset($validated['tg-link'])) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::TELEGRAM,
                'link' => $validated['tg-link'],
            ]);
        }

        if (isset($validated['inst-link'])) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::INSTAGRAM,
                'link' => $validated['inst-link'],
            ]);
        }

        if (isset($validated['yt-link'])) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::YOUTUBE,
                'link' => $validated['yt-link'],
            ]);
        }

        if (isset($validated['vk-link'])) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::VK,
                'link' => $validated['vk-link'],
            ]);
        }

        foreach ($validated['themes'] as $theme_id) {
            BloggerTheme::create([
                'blogger_id' => $blogger->id,
                'theme_id' => (int) $theme_id,
            ]);
        }

        return redirect()->route('profile');
    }

    public function show(Blogger $blogger)
    {
        $user = $blogger->user;
        $works = Work::where([['blogger_id', $user->id]])->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->get();
        return view('profile.public.blogger', compact('user', 'projects'));
    }

    public function info(Blogger $blogger)
    {
        $user = $blogger->user;

        return response()->json(['user' => $user, 'blogger' => $blogger, 'platforms' => $blogger->platforms], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogger $blogger)
    {
        //
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
