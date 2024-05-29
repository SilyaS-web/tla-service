<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        return response()->json('success');
    }

    public function show(Blogger $blogger)
    {
        $user = $blogger->user;
        $works = Work::where([['blogger_id', $user->id]])->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->get();
        return view('profile.public.blogger', compact('user', 'projects'));
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
