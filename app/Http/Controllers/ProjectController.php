<?php

namespace App\Http\Controllers;

use App\Models\Blogger;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectWork;
use App\Models\Theme;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_type' => [Rule::in(Project::TYPES), 'nullable'],
            'project_name' => 'string|nullable',
            'type' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            $projects = [];
            return view("project.index", compact('projects'));
        }

        $validated = $validator->validated();
        $user = Auth::user();

        $filter = [];

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $filter[] = ['product_name', 'like', '%' . $validated['project_name'] . '%'];
        }

        $projects = $user->projects()->where($filter)->withCount(['works' => function (Builder $query) {
            $query->where('status', 1);
        }]);

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        if ($user->role == 'blogger') {
            $works = Work::where([['blogger_id', $user->id]])->get();
            $projects->whereIn('id', $works->pluck('project_id'))->get();
            $projects = $projects->get();
            return view("project.blogger-list", compact('projects'));
        }

        $projects = $projects->get();

        if ($validated['type'] == 'select-project-page') {
            return view('project.seller-list', compact('projects'));
        }

        return view("project.index", compact('projects'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback-quantity' => 'numeric|nullable',
            'inst-quantity' => 'numeric|nullable',
            'youtube-quantity' => 'numeric|nullable',
            'vk-quantity' => 'numeric|nullable',
            'telegram-quantity' => 'numeric|nullable',
            'product_name' => 'required|min:3|max:250',
            'product_nm' => 'required|numeric|digits_between:1,14',
            'product_link' => 'required|min:3|max:1000',
            'product_price' => 'required|numeric|digits_between:1,14',
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile')->withErrors($validator)->withInput()->with('switch-tab', 'create-project');
        }

        $validated = $validator->validated();
        if (
            (!isset($validated['feedback-quantity']) || $validated['feedback-quantity'] < 1) &&
            (!isset($validated['inst-quantity']) || $validated['inst-quantity'] < 1) &&
            (!isset($validated['youtube-quantity']) || $validated['youtube-quantity'] < 1) &&
            (!isset($validated['vk-quantity']) || $validated['vk-quantity'] < 1) &&
            (!isset($validated['telegram-quantity']) || $validated['telegram-quantity'] < 1)
        ) {
            return redirect()->route('profile')->with('success', 'Количество видов рекламы не было выбрано')->with('switch-tab', 'create-project')->withInput();
        }

        $user = Auth::user();
        $validated['seller_id'] = $user->id;
        if (strripos($validated['product_link'], 'ozon') !== false && !empty($user->seller->ozon_client_id) && !empty($user->seller->ozon_api_key)) {
            $info = $this->getOzonInfo($validated['product_nm'], $user->seller->ozon_client_id, $user->seller->ozon_api_key);
            if ($info) {
                $validated['marketplace_category'] = $info['category'] ?? null;
                $validated['marketplace_brand'] = $info['brand'] ?? null;
                $validated['marketplace_product_name'] = $info['name'] ?? null;
                $validated['marketplace_description'] = $info['description'] ?? null;
                $validated['marketplace_options'] = json_encode($info['options'] ?? null);
            }
        } else if (strripos($validated['product_link'], 'wb') !== false || strripos($validated['product_link'], 'wildberries') !== false) {
            $card = $this->curlWBStats($validated['product_nm']);
            if (isset($card->imt_name)) {
                $validated['marketplace_category'] = $card->subj_name ?? null;
                $validated['marketplace_brand'] = $card->selling->brand_name ?? null;
                $validated['marketplace_product_name'] = $card->imt_name ?? null;
                $validated['marketplace_description'] = $card->description ?? null;
                $validated['marketplace_options'] = isset($card->options) ? json_encode($card->options) : null;
            }
        }

        $validated['status'] = Project::ACTIVE;
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

        if (isset($validated['youtube-quantity']) && $validated['youtube-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::YOUTUBE,
                'quantity' => $validated['youtube-quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['vk-quantity']) && $validated['vk-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::VK,
                'quantity' => $validated['vk-quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['telegram-quantity']) && $validated['telegram-quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::TELEGRAM,
                'quantity' => $validated['telegram-quantity'],
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

        return redirect()->route('profile')->with('success', 'Проект успешно создан')->with('switch-tab', 'profile-projects');
    }

    public function selectBloggers($project_id)
    {
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
            'project_name' => 'string|nullable',
            'project_type' => 'string|nullable',
            'category' => 'string|nullable',
            'type' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = Auth::user();
        $validated = $validator->validated();
        $type = $validated['type'] ?? null;

        if (isset($validated['type']) && $validated['type'] == 'applications') {
            $application_works = Work::where([['blogger_id', $user_id]])->where('created_by', '<>', $user_id)->where('accepted_by_blogger_at', null);

            if (isset($validated['project_type']) && !empty($validated['project_type'])) {
                $application_works->whereHas('projectWork', function (Builder $query) use ($validated) {
                    $query->where('type', $validated['project_type']);
                });
            }

            if (isset($validated['project_name']) && !empty($validated['project_name'])) {
                $application_works->whereHas('project', function (Builder $query) use ($validated) {
                    $query->where('product_name', 'like', '%' . $validated['project_name'] . '%');
                });
            }

            if (isset($validated['category']) && !empty($validated['project_name'])) {
                $application_works->whereHas('project', function (Builder $query) use ($validated) {
                    $query->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
                });
            }

            $project_works = $application_works->get();
            $type = 'applications';
            return view('project.blogger-list', compact('project_works', 'role', 'user_id', 'type'));
        } else if (!isset($validated['type'])) {
            $all_projects = Project::where('status', '<>', Project::BANNED)->where('created_at', '<', Carbon::now()->subMinutes(5))->where('is_blogger_access', true);

            if (isset($validated['project_type']) && !empty($validated['project_type'])) {
                $all_projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                    $query->where('type', $validated['project_type']);
                });
            }

            if (isset($validated['project_name']) && !empty($validated['project_name'])) {
                $all_projects->where('product_name', 'like', '%' . $validated['project_name'] . '%');
            }

            if (isset($validated['category']) && !empty($validated['category'])) {
                $all_projects->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
            }

            $all_projects = $all_projects->get();
            $type = 'all';
            return view('project.all-blogger-list', compact('all_projects', 'role', 'user_id', 'type'));
        }

        $works = Work::where([['blogger_id', $user_id]]);

        if (isset($validated['type']) && $validated['type'] == 'works') {
            $works->where('status', Work::IN_PROGRESS);
        }

        $works = $works->get();
        $project_works = ProjectWork::whereIn('id', $works->pluck('project_work_id'));
        $project_works->whereHas('project', function (Builder $query) {
            $query->where('status', '<>', Project::BANNED)->where('is_blogger_access', true);
        });

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $project_works->where('type', $validated['project_type']);
        }

        if (isset($validated['project_name']) && !empty($validated['project_name'])) {
            $project_works->whereHas('project', function (Builder $query) use ($validated) {
                $query->where('product_name', 'like', '%' . $validated['project_name'] . '%');
            });
        }

        if (isset($validated['category']) && !empty($validated['project_name'])) {
            $project_works->whereHas('project', function (Builder $query) use ($validated) {
                $query->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
            });
        }

        $project_works = $project_works->get();

        return view('project.blogger-list', compact('project_works', 'type'));
    }

    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $validator = Validator::make(request()->all(), [
            'product_name' => 'required|min:3|max:250',
            'product_nm' => 'required|min:3|numeric',
            'product_link' => 'required|min:3|max:1000',
            'product_price' => 'required|numeric',
            'uploaded_images' => 'array',
            'uploaded_images.*' => 'numeric',
            'images' => 'array',
            'images.*' => 'image|max:10240',
            'feedback-quantity' => 'numeric|nullable',
            'inst-quantity' => 'numeric|nullable',
            'youtube-quantity' => 'numeric|nullable',
            'vk-quantity' => 'numeric|nullable',
            'telegram-quantity' => 'numeric|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        $product_images = request()->file('images');
        if (empty($product_images) && empty($validated['uploaded_images'])) {
            return redirect()->back()->with('success', 'Выберите хотя бы одно изображение для проекта');
        }

        foreach ($project->projectFiles as $file) {
            if (!isset($validated['uploaded_images']) || empty($validated['uploaded_images']) || !in_array($file->id, $validated['uploaded_images'])) {
                $file->delete();
            }
        }

        if (!empty($product_images)) {
            foreach ($product_images as $product_image) {
                $image_path = $product_image->store('projects', 'public');
                ProjectFile::create([
                    'source_id' => $project->id,
                    'type' => 0,
                    'link' => $image_path,
                ]);
            }
        }

        $project->update($validated);

        foreach (Project::TYPES as $type) {
            $project_work = $project->projectWorks()->where('type', $type)->first();
            if ($project_work) {
                if (!isset($validated[$type . '-quantity']) || $validated[$type . '-quantity'] == 0) {
                    $project_work->delete();
                } else {
                    $project_work->update([
                        'quantity' => $validated[$type . '-quantity'],
                    ]);
                }
            } else {
                if (isset($validated[$type . '-quantity']) && $validated[$type . '-quantity'] > 0) {
                    ProjectWork::create([
                        'type' => $type,
                        'quantity' => $validated[$type . '-quantity'],
                        'project_id' => $project->id,
                    ]);
                }
            }
        }

        return redirect()->route('profile')->with('success', 'Проект успешно обновлён')->with('switch-tab', 'profile-projects');
    }

    public function destroy($id)
    {
        if ($project = Project::find($id)) {
            $project->delete();
            return redirect()->route('profile')->with('success', 'Проект успешно удалён');
        }

        return redirect()->route('profile')->with('success', 'Произошла ошибка при удалении проекта');
    }

    public function activate(Project $project)
    {
        $user = Auth::user();
        foreach ($project->projectWorks as $project_work) {
            $seller_tariff = $user->getActiveTariffs($project_work->type);
            if (!$seller_tariff || $seller_tariff->quantity < $project_work->quantity) {
                return redirect()->back()->with('success', 'Вашего тарифа недостаточно для того, чтобы опубликовать');
            }
        }

        foreach ($project->projectWorks as $project_work) {
            $seller_tariff = $user->getActiveTariffs($project_work->type);
            $project_work->update(['finish_date' => $seller_tariff->finish_date]);
            $seller_tariff->update(['quantity' => $seller_tariff->quantity - $project_work->quantity]);
        }

        $project->update(['is_blogger_access' => true]);
        return redirect()->route('profile')->with('switch-tab', 'profile-projects')->with('success', 'Проект успешно опубликован');
    }

    public function ban(Project $project)
    {
        $project->update(['status' => Project::BANNED]);
        return redirect()->route('profile')->with('switch-tab', 'projects-list');
    }

    public function unban(Project $project)
    {
        $project->update(['status' => Project::ACTIVE]);
        return redirect()->route('profile')->with('switch-tab', 'projects-list');
    }

    public function delete(Project $project)
    {
        $user = Auth::user();
        if ($project->is_blogger_access) {
            foreach ($project->projectWorks as $project_work) {
                $seller_tariff = $user->getActiveTariffs($project_work->type);
                if ($seller_tariff) {
                    $lost = $project_work->quantity - $project->works()->where('project_work_id', $project_work->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
                    $seller_tariff->update(['quantity' => $seller_tariff->quantity + $lost]);
                }
            }
        }

        $project->delete();
        return redirect()->route('profile')->with('switch-tab', 'projects-list')->with('success', 'Проект удалён');;
    }

    public function stop(Project $project)
    {
        $project->update(['status' => Project::STOPPED]);
        return redirect()->route('profile')->with('switch-tab', 'projects-list')->with('success', 'Проект остановлен');
    }

    public function start(Project $project)
    {
        $project->update(['status' => Project::ACTIVE]);
        return redirect()->route('profile')->with('switch-tab', 'projects-list')->with('success', 'Проект возобновлён');
    }

    public function categories()
    {
        $validator = Validator::make(request()->all(), [
            'category' => 'string|nullable',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $categories = [];

        if (isset($validated['category']) && !empty($validated['category'])) {
            $categories = Project::selectRaw('marketplace_category as theme')->where('marketplace_category', 'like', '%' . $validated['category'] . '%')->distinct('marketplace_category')->get();
        }

        return response()->json(['categories' => $categories], 200);
    }

    public function getProductInfo(Project $project)
    {
        $total_quantity = $project->projectWorks()->sum('quantity');
        $lost_quantity = $total_quantity - $project->works()->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();

        return response()->json([
            'category' => $project->marketplace_category,
            'product_name' => $project->marketplace_product_name ?? $project->product_name,
            'description' => $project->marketplace_description,
            'total_quantity' => $total_quantity,
            'lost_quantity' => $lost_quantity,
            'product_code' => $project->product_nm,
            'price' =>  $project->product_price,
            'images' => $project->getImageURL(),
            'optioins' => $project->marketplace_options != 'null' ? $project->marketplace_options : NULL,
            'link' => $project->product_link,
            'application_sent' => $project->isSended(),
        ], 200);
    }

    public function getApplicationsCount()
    {
        $user = Auth::user();
        $projects = $user->projects;
        $application_count_by_projects = [];
        foreach ($projects as $project) {
            $application_count_by_projects[$project->id] = $project->works()->where('status', null)->where('created_by', '<>', $user->id)->count();
        }

        return $application_count_by_projects;
    }
}
