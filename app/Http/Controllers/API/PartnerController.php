<?php

namespace App\Http\Controllers\API;

use App\Models\Partner;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;
use App\Http\Resources\PartnerResource;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $partners  = Partner::all();

        $data = [
            'partners' => PartnerResource::collection($partners),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Partner $partner)
    {

        return response()->json(new PartnerResource($partner))->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Partner $partner)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        return response()->json([])->setStatusCode(200);
    }
}
