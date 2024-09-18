<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\TariffResource;
use App\Models\Tariff;
use App\Services\TariffService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TariffController extends Controller
{
    public function index(Request $request) {
        $validator = Validator::make($request->all(), [
            'is_active' => 'boolean|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $tariffs = Tariff::where([]);
        if (isset($validated['is_active']) && !empty($validated['is_active'])) {
            $tariffs->offset(0)->limit($validated['is_active']);
        }

        $data = [
            'tariffs' => TariffResource::collection($tariffs->get()),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function getPrice(Tariff $tariff, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'string|required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors())->setStatusCode(400);
        }

        $validated = $validator->validated();

        $price = TariffService::getPrice($tariff->type, $validated['quantity']);

        if (!$price) {
            return response()->json(['message' => 'Выбрано некорректное количиство или неподходящий тариф'])->setStatusCode(400);
        }

        return response()->json(['price' => $price])->setStatusCode(200);
    }
}
