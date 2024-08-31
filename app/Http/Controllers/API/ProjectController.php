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
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();
        if (
            (!isset($validated['feedback-quantity']) || $validated['feedback-quantity'] < 1) &&
            (!isset($validated['inst-quantity']) || $validated['inst-quantity'] < 1) &&
            (!isset($validated['youtube-quantity']) || $validated['youtube-quantity'] < 1) &&
            (!isset($validated['vk-quantity']) || $validated['vk-quantity'] < 1) &&
            (!isset($validated['telegram-quantity']) || $validated['telegram-quantity'] < 1)
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
