<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformResource;
use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $payments = ThemeResource::collection(Theme::all());
        $data = [
            'themes' => $payments,
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
