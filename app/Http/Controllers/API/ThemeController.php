<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\JsonResponse;

class ThemeController extends Controller
{
    public function index(): JsonResponse
    {
        $payments = ThemeResource::collection(Theme::all());
        $data = [
            'themes' => $payments,
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
