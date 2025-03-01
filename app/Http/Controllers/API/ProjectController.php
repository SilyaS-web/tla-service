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
use App\Models\User;
use App\Models\Work;
use App\Services\ImageService;
use App\Services\OzonService;
use App\Services\WbService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'order_by_created_at' => 'string|nullable',
            'order_by_product_price' => 'string|nullable',
            'project_type' => [Rule::in(Project::TYPES), 'nullable'],
            'category' => 'string|nullable',
            'product_name' => 'string|nullable',
            'statuses' => 'array|nullable',
            'statuses.*' => 'string',
            'status' => 'string|nullable',
            'is_blogger_access' => 'boolean|nullable',
            'limit' => 'array|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $projects = Project::where([]);

        if (!empty($validated['statuses'])) {
            $projects->whereIn('status', $validated['statuses']);
        }

        if (!empty($validated['product_name'])) {
            $projects->where('product_name', 'like', '%' . $validated['product_name'] . '%');
        }

        $user = Auth()->user();
        if ($user->role === 'blogger') {
            if ($user->blogger->platforms()->max('coverage') < 2000) {
                $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                    $query->where('type', Project::FEEDBACK);
                });
            }
        } else {
            if (!empty($validated['project_type'])) {
                $projects->whereHas('projectWorks', function (Builder $query) use ($validated) {
                    $query->where('type', $validated['project_type']);
                });
            }
        }

        if (!empty($validated['category'])) {
            $projects->where('marketplace_category', 'like', '%' . $validated['category'] . '%');
        }

        if (!empty($validated['is_blogger_access'])) {
            $projects->where('is_blogger_access', $validated['is_blogger_access']);
        }

        if (!empty($validated['limit']) && !empty($validated['limit'])) {
            $projects->skip($validated['limit'][0])->take($validated['limit'][1]);
        }

        if (!empty($validated['status'])) {
            if ($validated['status'] == 'active') {
                $projects->where('status', '>=', 0);
            } else {
                $projects->where('status', '<', 0);
            }
        }
        $sort_fields = [];

        if (!empty($validated['order_by_product_price'])) {
            $sort_fields['product_price'] = $validated['order_by_product_price'];
        } else {
            if (isset($validated['order_by_created_at'])) {
                $sort_fields['created_at'] = $validated['order_by_created_at'];
            } else {
                $sort_fields['created_at'] = 'desc';
            }
        }

        $projects->ofSort($sort_fields);

        $data = [
            'projects' => ProjectResource::collection($projects->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'integration_types' => 'required|array',
            'integration_types.*' => ['string', Rule::in(Project::TYPES)],
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

        if (empty($validated['integration_types'])) {
            return response()->json(['message' => 'Вы не выбрали формат рекламы'])->setStatusCode(400);
        }

        $user = $request->user();
        $validated['seller_id'] = $user->id;

        if (strlen($validated['product_nm']) > 9) {
            $validated['product_link'] = 'https://www.ozon.ru/product/' . $validated['product_nm'];
            if ($user->seller->ozon_client_id && $user->seller->ozon_api_key) {
                $info = OzonService::getProductInfo($validated['product_nm'], $user->seller->ozon_client_id, $user->seller->ozon_api_key);
                if ($info) {
                    $validated['marketplace_category'] = $info['category'] ?? null;
                    $validated['marketplace_brand'] = $info['brand'] ?? null;
                    $validated['marketplace_product_name'] = $info['name'] ?? null;
                    $validated['marketplace_description'] = $info['description'] ?? null;
                    $validated['marketplace_options'] = json_encode($info['options'] ?? null);
                }
            }
        } else {
            $validated['product_link'] = 'https://www.wildberries.ru/catalog/' . $validated['product_nm'] . '/detail.aspx';
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

        foreach ($validated['integration_types'] as $integration_type) {
            ProjectWork::create([
                'type' => $integration_type,
                'quantity' => -1,
                'project_id' => $project->id,
            ]);
        }

        $product_images = $request->file('images');
        foreach ($product_images as $product_image) {
            $urls = ImageService::makeCompressedCopies($product_image, 'projects/' . $project->id . '/');

            ProjectFile::create([
                'source_id' => $project->id,
                'type' => 0,
                'link' => $urls[1],
            ]);
        }

        return response()->json()->setStatusCode(200);
    }

    public function show(Project $project): JsonResponse
    {
        $data = new ProjectResource($project);

        return response()->json($data)->setStatusCode(200);
    }

    public function ban(Project $project): JsonResponse
    {
        $project->update(['status' => Project::BANNED]);
        return response()->json()->setStatusCode(200);
    }

    public function unban(Project $project): JsonResponse
    {
        $project->update(['status' => Project::STOPPED]);
        return response()->json()->setStatusCode(200);
    }

    public function update(Project $project): JsonResponse
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
            'integration_types' => 'required|array',
            'integration_types.*' => ['string', Rule::in(Project::TYPES)],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        if (empty($validated['integration_types'])) {
            return response()->json(['message' => 'Количество видов рекламы не было выбрано'])->setStatusCode(400);
        }

        $product_images = request()->file('images');
        if (empty($product_images) && empty($validated['uploaded_images'])) {
            return response()->json(['images' => ['Выберите хотя бы одно изображение для проекта']])->setStatusCode(400);
        }

        foreach ($project->projectFiles as $file) {
            if (empty($validated['uploaded_images']) || !in_array($file->id, $validated['uploaded_images'])) {
                $file->delete();
            }
        }

        if (!empty($product_images)) {
            foreach ($product_images as $product_image) {
                $urls = ImageService::makeCompressedCopies($product_image, 'projects/' . $project->id . '/');

                ProjectFile::create([
                    'source_id' => $project->id,
                    'type' => 0,
                    'link' => $urls[1],
                ]);
            }
        }

        $project->update($validated);

        return response()->json([])->setStatusCode(200);
    }

    public function delete(Project $project): JsonResponse
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

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return response()->json()->setStatusCode(200);
    }

    public function activate(Project $project): JsonResponse
    {
        $project->update(['is_blogger_access' => true]);
        return response()->json()->setStatusCode(200);
    }

    public function stop(Project $project): JsonResponse
    {
        if ($project->status === Project::ACTIVE) {
            $project->update(['status' => Project::STOPPED]);
            return response()->json()->setStatusCode(200);
        }

        return response()->json(['message' => 'Нельзя изменить статус проекта из текущего статуса '])->setStatusCode(400);
    }

    public function start(Project $project)
    {
        if ($project->status == Project::STOPPED) {
            $project->update(['status' => Project::ACTIVE]);
            return response()->json()->setStatusCode(200);
        }

        return response()->json(['message' => 'Нельзя изменить статус проекта из текущего статуса '])->setStatusCode(400);
    }

    public function works(Project $project, Request $request): JsonResponse
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
            $seller_id = $project->seller_id;

            if ($validated['status'] == 'active') {
                $works = $project->works()->where(function (Builder $query) use ($seller_id) {
                    $query->where('created_by', $seller_id)->where('status', '<>', Work::CANCELED)->orWhere('status', '<>', null);
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
        if (!empty($validated['creator_role'])) {
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

    public function getProductInfo(Project $project): JsonResponse
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

    public function getApplicationsCount(): array
    {
        $user = Auth::user();
        $projects = $user->projects;
        $application_count_by_projects = [];
        foreach ($projects as $project) {
            $application_count_by_projects[$project->id] = $project->works()->where('status', null)->where('created_by', '<>', $user->id)->count();
        }

        return $application_count_by_projects;
    }

    public function categories(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'category' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        if (!empty($validated['category'])) {
            $categories = Project::selectRaw('marketplace_category as theme')->where('marketplace_category', 'like', '%' . $validated['category'] . '%')->distinct('marketplace_category')->get();
        } else {
            $categories = Project::selectRaw('marketplace_category as theme')->distinct('marketplace_category')->whereNotNull('marketplace_category')->get();
        }

        return response()->json(['categories' => $categories])->setStatusCode(200);
    }

    public function statistics(Project $project): JsonResponse
    {
        $data = [
            'statistics' => new ProjectStatisticsResource($project),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function types()
    {

    }
}
