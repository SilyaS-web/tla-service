<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
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
            'platform' => [Rule::in(Blogger::PLATFORM_TYPES)],
            'user_id' => 'exists:users,id',
            'subscriber_quantity_min' => 'numeric',
            'subscriber_quantity_max' => 'numeric',
        ]);

        if ($validator->fails()) {
            $bloggers = [];
            return view('blogger.list', compact('bloggers'));
        }

        $validated = $validator->validated();

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        $filter = [];
        if (isset($validated['platform']) && !empty($validated['platform'])) {
            $filter[] = ['platform', $validated['platform']];
        }

        if (isset($validated['subscriber_quantity_min']) && !empty($validated['subscriber_quantity_min'])) {
            $filter[] = ['subscriber_quantity', '>=', $validated['subscriber_quantity_min']];
        }

        if (isset($validated['subscriber_quantity_max']) && !empty($validated['subscriber_quantity_max'])) {
            $filter[] = ['subscriber_quantity', '<=', $validated['subscriber_quantity_max']];
        }

        $bloggers = [];

        if (!empty($validated['name']) && $validated['name'] != '') {
            $bloggers = Blogger::whereHas('user', function (Builder $query) use ($validated) {
                $query->where('name', 'like', '%' . $validated['name'] . '%');
            })->where($filter)->get();
        } else {
            $bloggers = Blogger::where($filter)->get();
        }

        return view("blogger.list", compact('bloggers'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desc' => 'string|nullable',
            'sex' => 'required|string',
            'tg-link' => 'string|nullable',
            'inst-link' => 'string|nullable',
            'yt-link' => 'string|nullable',
        ]);

        if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $validated = $validator->validated();
        $blogger = Blogger::create([
            'user_id' => $user->id,
            'description' => $validated['desc'] ?? null,
            'sex' => $validated['sex'],
        ]);

        if ($validated['tg-link']) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::TELEGRAM,
                'link' => $validated['tg-link'],
            ]);
        }

        if ($validated['inst-link']) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::INSTAGRAM,
                'link' => $validated['inst-link'],
            ]);
        }

        if ($validated['yt-link']) {
            BloggerPlatform::create([
                'blogger_id' => $blogger->id,
                'name' => BloggerPlatform::YOUTUBE,
                'link' => $validated['yt-link'],
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

        return response()->json(['user' => $user, 'blogger' => $blogger, 'platforms'=> $blogger->platforms], 200);
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
