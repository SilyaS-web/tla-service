<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformResource;
use App\Models\Platform;
use Illuminate\Http\JsonResponse;

class PlatformController extends Controller
{
    public function index(): JsonResponse
    {
        $payments = PlatformResource::collection(Platform::all());
        $data = [
            'platforms' => $payments,
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
