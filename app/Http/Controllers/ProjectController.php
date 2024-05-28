<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_type' => [Rule::in(Project::TYPES)],
            'project_name' => '',
            'status' => '',
            'user_id' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            $projects = [];
            return view("project.index", compact('projects'));
        }

        $validated = $validator->validated();

        $user = Auth::user();
        if (!$user) {
            $user = User::find($request->user_id);
        }

        $filter = [];
        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $filter[] = ['project_type', $validated['project_type']];
        }

        if (isset($validated['status']) && !empty($validated['status'])) {
            $filter[] = ['status', $validated['status']];
        }

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $filter[] = ['project_name', 'like', '%' . $validated['project_name'] . '%'];
        }
        $projects = $user->projects()->where($filter)->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }])->get();

        if ($user->role == 'seller') {
            return view("project.seller-list", compact('projects'));
        }

        return view("project.index", compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("project.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_type' => ['required', Rule::in(Project::TYPES)],
            'project_name' => 'required|min:3',
            'product_name' => 'required|min:3',
            'product_link' => 'required|min:3',
            'product_price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $validated['seller_id'] = Auth::user()->id;

        $project = Project::create($validated);

        $product_images = $request->file('images');
        foreach ($product_images as $product_image) {
            $image_path = $product_image->store('projects', 'public');
            ProjectFile::create([
                'source_id' => $project->id,
                'type' => 0,
                'link' => $image_path,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Проект успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Project $project)
    {
        $validator = Validator::make(request()->all(), [
            'project_type' => ['required', Rule::in(Project::TYPES)],
            'project_name' => 'required|min:3',
            'product_name' => 'required|min:3',
            'product_link' => 'required|min:3',
            'product_price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $project->update($validated);

        $product_images = request()->file('images');
        foreach ($product_images as $product_image) {
            $image_path = $product_image->store('projects', 'public');
            ProjectFile::create([
                'source_id' => $project->id,
                'type' => 0,
                'link' => $image_path,
            ]);
        }

        return redirect()->route('profile')->with('success', 'Проект успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        if ($project = Project::find($id)) {
            $project->delete();
            return redirect()->route('profile')->with('success', 'Проект успешно удалён');
        }

        return redirect()->route('profile')->with('success', 'Произошла ошибка при удалении проекта');
    }
}
