<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformResource;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        $payments = PlatformResource::collection(Platform::all());
        $data = [
            'platforms' => $payments,
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
