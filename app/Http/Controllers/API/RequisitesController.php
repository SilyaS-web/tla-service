<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Requisites\StoreRequisitesRequest;
use App\Http\Resources\RequisitesResource;
use App\Models\Requisites;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RequisitesController extends Controller
{
    public function store(StoreRequisitesRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $requisites = Requisites::create($validated);

        return response()->json(new RequisitesResource($requisites), 200);
    }
}
