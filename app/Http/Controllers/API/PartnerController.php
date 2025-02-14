<?php

namespace App\Http\Controllers\API;

use App\Models\Partner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function index(): JsonResponse
    {
        $partners  = Partner::all();

        $data = [
            'partners' => PartnerResource::collection($partners),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'description' => 'string|nullable',
            'image' => 'string|required',
            'code' => 'string|nullable',
            'code_description' => 'string|nullable',
            'link' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $partner = Partner::query()->create($validated);
        return response()->json($partner)->setStatusCode(200);
    }

    public function show(Partner $partner): JsonResponse
    {

        return response()->json(new PartnerResource($partner))->setStatusCode(200);
    }

    public function update(Request $request, Partner $partner): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|required',
            'description' => 'string|nullable',
            'image' => 'string|required',
            'code' => 'string|nullable',
            'code_description' => 'string|nullable',
            'link' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $partner::query()->update($validated);
        return response()->json($partner)->setStatusCode(200);
    }

    public function destroy(Partner $partner): JsonResponse
    {
        $partner->delete();
        return response()->json([])->setStatusCode(200);
    }
}
