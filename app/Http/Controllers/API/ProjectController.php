<?php

namespace App\Http\Controllers\API;

use App\Models\Seller;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\ProjectFile;
use App\Models\ProjectWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::all();

        $data = [
            'projects' => ProjectResource::collection($projects),
        ];

        return response()->json($data)->setStatusCode(200);
    }


    public function store(Request $request) {
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
            $image_path = $product_image->store('projects', 'public');
            ProjectFile::create([
                'source_id' => $project->id,
                'type' => 0,
                'link' => $image_path,
            ]);
        }

        return response()->json()->setStatusCode(200);
    }


    public function show(Project $project) {
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogger  $blogger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $blogger)
    {
        //
    }
}
