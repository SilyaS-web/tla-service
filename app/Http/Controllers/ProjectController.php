<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectWork;
use App\Models\User;
use App\Models\Work;
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
            'product_name' => '',
            'status' => '',
            'user_id' => 'exists:users,id|nullable',
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
        if (isset($validated['status']) && !empty($validated['status'])) {
            $filter[] = ['status', $validated['status']];
        }

        if (isset($validated['product_name']) && !empty($validated['product_name'])) {
            $filter[] = ['product_name', 'like', '%' . $validated['product_name'] . '%'];
        }
        $projects = $user->projects()->where($filter)->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }])->get();

        if ($user->role == 'blogger') {
            $works = Work::where([['blogger_id', $user->id]])->get();
            $projects = Project::whereIn('id', $works->pluck('project_id'))->where($validated)->get();
            return view("project.blogger-list", compact('projects'));
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
            'feedback-quantity' => 'numeric|nullable',
            'inst-quantity' => 'numeric|nullable',
            'product_name' => 'required|min:3',
            'product_nm' => 'required|min:3|numeric',
            'product_link' => 'required|min:3',
            'product_price' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        if ((!isset($validated['feedback-quantity']) || $validated['feedback-quantity'] < 1) && (!isset($validated['inst-quantity']) || $validated['inst-quantity'] < 1)) {
            return redirect()->route('profile')->with('success', 'Количество видов рекламы не было выбрано')->with('switch-tab', 'create-project')->withInput();
        }

        $validated['seller_id'] = Auth::user()->id;

        $project = Project::create($validated);

        if (isset($validated['feedback-quantity']) && $validated['feedback-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::FEEDBACK,
                'quantity' => $validated['feedback-quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['inst-quantity']) && $validated['inst-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::INSTAGRAM,
                'quantity' => $validated['inst-quantity'],
                'project_id' => $project->id,
            ]);
        }

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

    public function selectBloggers($project_id){
        $project = Project::find($project_id);
        $bloggers = Blogger::get();
        return view('seller.select-blogger', compact('project', 'bloggers'));
    }

    public function bloggerProjects(Request $request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $role = $user->role;

        $validator = Validator::make(request()->all(), [
            'product_name' => '',
            'status' => '',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $works = Work::where([['blogger_id', $user_id]])->get();
        $projects = Project::whereIn('id', $works->pluck('project_id'))->where($validated)->get();

        return view('project.blogger-list', compact('projects', 'works', 'role', 'user_id'));
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
