<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProjectStatisticsResource;
use App\Http\Resources\WorkResource;
use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectWork;
use App\Models\Work;
use App\Services\ImageService;
use App\Services\OzonService;
use App\Services\WbService;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_by_created_at' => 'string|nullbale',
            'project_type' => [Rule::in(Project::TYPES), 'nullable'],
            'category' => 'string|nullable',
            'product_name' => 'string|nullable',
            'statuses' => 'array|nullable',
            'statuses.*' => 'string',
            'status' => 'string|nullable',
            'is_blogger_access' => 'boolean|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $projects = Project::where([]);

        if (isset($validated['statuses']) && !empty($validated['statuses'])) {
            $projects->whereIn('status', $validated['statuses']);
        }

        if (isset($validated['product_name']) && !empty($validated['product_name'])) {
            $projects->where('product_name', 'like', '%' . $validated['product_name'] . '%');
        }

        if (isset($validated['project_type']) && !empty($validated['project_type'])) {
            $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                $query->where('type', $validated['project_type']);
            });
        }

        if (isset($validated['category']) && !empty($validated['category'])) {
            $projects->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
        }

        if (isset($validated['order_by_created_at']) && !empty($validated['order_by_date'])) {
            $projects->orderBy('created_at', $validated['order_by_created_at']);
        } else {
            $projects->orderBy('created_at', 'desc');
        }

        if (isset($validated['is_blogger_access']) && !empty($validated['is_blogger_access'])) {
            $projects->where('is_blogger_access', $validated['is_blogger_access']);
        }

        if (isset($validated['status']) && !empty($validated['status'])) {
            if ($validated['status'] == 'active') {
                $projects->where('status', '>=', 0);
            } else {
                $projects->where('status', '<', 0);
            }
        }

        $data = [
            'projects' => ProjectResource::collection($projects->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'feedback_quantity' => 'numeric|nullable',
            'inst_quantity' => 'numeric|nullable',
            'youtube_quantity' => 'numeric|nullable',
            'vk_quantity' => 'numeric|nullable',
            'telegram_quantity' => 'numeric|nullable',
            'product_name' => 'required|min:3|max:250',
            'product_nm' => 'required|numeric|digits_between:1,14',
            'product_link' => 'required|min:3|max:1000',
            'product_price' => 'required|numeric|digits_between:1,14',
            'images' => 'required|array',
            'images.*' => 'image|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();
        if (
            (!isset($validated['feedback_quantity']) || $validated['feedback_quantity'] < 1) &&
            (!isset($validated['inst_quantity']) || $validated['inst_quantity'] < 1) &&
            (!isset($validated['youtube_quantity']) || $validated['youtube_quantity'] < 1) &&
            (!isset($validated['vk_quantity']) || $validated['vk_quantity'] < 1) &&
            (!isset($validated['telegram_quantity']) || $validated['telegram_quantity'] < 1)
        ) {

            return response()->json(['message' => 'Количество видов рекламы не было выбрано'])->setStatusCode(400);
        }
        $user = $request->user();
        $validated['seller_id'] = $user->id;
        if (strripos($validated['product_link'], 'ozon') !== false && !empty($user->seller->ozon_client_id) && !empty($user->seller->ozon_api_key)) {
            $info = OzonService::getProductInfo($validated['product_nm'], $user->seller->ozon_client_id, $user->seller->ozon_api_key);
            if ($info) {
                $validated['marketplace_category'] = $info['category'] ?? null;
                $validated['marketplace_brand'] = $info['brand'] ?? null;
                $validated['marketplace_product_name'] = $info['name'] ?? null;
                $validated['marketplace_description'] = $info['description'] ?? null;
                $validated['marketplace_options'] = json_encode($info['options'] ?? null);
            }
        } else if (strripos($validated['product_link'], 'wb') !== false || strripos($validated['product_link'], 'wildberries') !== false) {
            $card = WbService::getProductInfo($validated['product_nm']);
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

        if (isset($validated['feedback_quantity']) && $validated['feedback_quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::FEEDBACK,
                'quantity' => $validated['feedback_quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['inst_quantity']) && $validated['inst_quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::INSTAGRAM,
                'quantity' => $validated['inst_quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['youtube_quantity']) && $validated['youtube_quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::YOUTUBE,
                'quantity' => $validated['youtube_quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['vk_quantity']) && $validated['vk_quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::VK,
                'quantity' => $validated['vk_quantity'],
                'project_id' => $project->id,
            ]);
        }

        if (isset($validated['telegram_quantity']) && $validated['telegram_quantity'] > 0) {
            ProjectWork::create([
                'type' => Project::TELEGRAM,
                'quantity' => $validated['telegram_quantity'],
                'project_id' => $project->id,
            ]);
        }

        $product_images = $request->file('images');
        foreach ($product_images as $product_image) {
            $urls = ImageService::makeCompressedCopies($product_image, 'projects/' .  $project->id . '/');

            ProjectFile::create([
                'source_id' => $project->id,
                'type' => 0,
                'link' => $urls[1],
            ]);
        }

        return response()->json()->setStatusCode(200);
    }

    public function show(Project $project)
    {
        $data = new ProjectResource($project);

        return response()->json($data)->setStatusCode(200);
    }

    public function ban(Project $project)
    {
        $project->update(['status' => Project::BANNED]);
        return response()->json()->setStatusCode(200);
    }

    public function unban(Project $project)
    {
        $project->update(['status' => Project::PENDING]);
        return response()->json()->setStatusCode(200);
    }

    public function update(Project $project)
    {
        if (!Auth::user()->sellerTariffs()->where('finish_date', '>', Carbon::now())->where('tariff_id', 20)->first()) {
            return response()->json(['message' => 'Приобретите подписку чтобы редактировать проект'])->setStatusCode(400);
        }

        $validator = Validator::make(request()->all(), [
            'product_name' => 'required|min:3|max:250',
            'product_nm' => 'required|min:3|numeric',
            'product_link' => 'required|min:3|max:1000',
            'product_price' => 'required|numeric',
            'uploaded_images' => 'array',
            'uploaded_images.*' => 'numeric',
            'images' => 'array',
            'images.*' => 'image|max:10240',
            'feedback_quantity' => 'numeric|nullable',
            'inst_quantity' => 'numeric|nullable',
            'youtube_quantity' => 'numeric|nullable',
            'vk_quantity' => 'numeric|nullable',
            'telegram_quantity' => 'numeric|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();
        $product_images = request()->file('images');
        if (empty($product_images) && empty($validated['uploaded_images'])) {
            return response()->json(['images' => ['Выберите хотя бы одно изображение для проекта']])->setStatusCode(400);
        }

        foreach ($project->projectFiles as $file) {
            if (!isset($validated['uploaded_images']) || empty($validated['uploaded_images']) || !in_array($file->id, $validated['uploaded_images'])) {
                $file->delete();
            }
        }

        if (!empty($product_images)) {
            foreach ($product_images as $product_image) {
                $urls = ImageService::makeCompressedCopies($product_image, 'projects/' .  $project->id . '/');

                ProjectFile::create([
                    'source_id' => $project->id,
                    'type' => 0,
                    'link' => $urls[1],
                ]);
            }
        }

        $project->update($validated);

        foreach (Project::TYPES as $type) {
            $project_work = $project->projectWorks()->where('type', $type)->first();
            if ($project_work) {
                if (isset($validated[$type . '_quantity']) && $validated[$type . '_quantity'] >= $project_work->quantity) {
                    $project_work->update([
                        'quantity' => $validated[$type . '_quantity'],
                    ]);
                }
            } else if (isset($validated[$type . '_quantity']) && $validated[$type . '_quantity'] > 0) {
                ProjectWork::create([
                    'type' => $type,
                    'quantity' => $validated[$type . '_quantity'],
                    'project_id' => $project->id,
                ]);
            }
        }
        return response()->json([])->setStatusCode(200);
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
        return response()->json()->setStatusCode(200);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json()->setStatusCode(200);
    }

    public function activate(Project $project)
    {
        $user = Auth::user();

        try {
            DB::transaction(function () use ($project, $user) {
                foreach ($project->projectWorks as $project_work) {
                    $seller_tariff = $user->getActiveTariffs($project_work->type);
                    if (!$seller_tariff || ($seller_tariff->quantity < $project_work->quantity && $seller_tariff->quantity >= 0)) {
                        throw new \Exception('Вашего тарифа недостаточно для того, чтобы опубликовать');
                    }

                    if ($seller_tariff->quantity >= 0) {
                        $new_quantity = $seller_tariff->quantity > $project_work->quantity ? $seller_tariff->quantity - $project_work->quantity : 0;
                        $seller_tariff->update(['quantity' => $new_quantity]);
                    }

                    $project_work->update(['finish_date' => $seller_tariff->finish_date]);
                }
            });
        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()])->setStatusCode(400);
        }

        $project->update(['is_blogger_access' => true]);
        return response()->json()->setStatusCode(200);
    }

    public function stop(Project $project)
    {
        $project->update(['status' => Project::STOPPED]);
        return response()->json()->setStatusCode(200);
    }

    public function start(Project $project)
    {
        $project->update(['status' => Project::ACTIVE]);
        return response()->json()->setStatusCode(200);
    }

    public function works(Project $project, Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'created_by' => 'string||nullable',
            'statuses' => 'array|nullable',
            'statuses.*' => 'string',
            'status' => 'string|nullable',
            'order_by_last_message' => 'string|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        if (isset($validated['status']) && !empty($validated['status'])) {
            $works = null;
            $seller_id = $project->seller_id;

            if ($validated['status'] == 'active') {
                $works = $project->works()->where(function (Builder $query) use ($seller_id) {
                    $query->where('created_by', $seller_id)->orWhere('status', '<>', null);
                });
            } else {
                $works = $project->works()->where('created_by', '<>', $seller_id)->where('status', null);
            }

            if (isset($validated['order_by_last_message']) && !empty($validated['order_by_last_message'])) {
                $works->orderBy('last_message_at', $validated['order_by_last_message']);
            }

            $data = [
                'works' => WorkResource::collection($works->get()),
            ];

            return response()->json($data)->setStatusCode(200);
        }

        $works = $project->works();
        if (isset($validated['creator_role']) && !empty($validated['creator_role'])) {
            if ($validated['creator_role'] == 'seller') {
                $works->where('created_by', $user->id);
            } else {
                $works->where('created_by', '<>', $user->id);
            }
        }
        if (isset($validated['statuses']) && !empty($validated['statuses'])) {
            $works->whereIn('status', $validated['statuses']);
        }

        $data = [
            'works' => WorkResource::collection($works->get()),
        ];

        return response()->json($data)->setStatusCode(200);
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
            'price' => $project->product_price,
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

    public function categories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();
        $categories = [];

        if (isset($validated['category']) && !empty($validated['category'])) {
            $categories = Project::selectRaw('marketplace_category as theme')->where('marketplace_category', 'like', '%' . $validated['category'] . '%')->distinct('marketplace_category')->get();
        } else {
            $categories = Project::selectRaw('marketplace_category as theme')->distinct('marketplace_category')->whereNotNull('marketplace_category')->get();
        }

        return response()->json(['categories' => $categories])->setStatusCode(200);
    }

    public function statistics(Project $project)
    {
        $data = [
            'statistics' => new ProjectStatisticsResource($project),
        ];

        return response()->json($data)->setStatusCode(200);

    }
}
