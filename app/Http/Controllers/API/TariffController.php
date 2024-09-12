<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tariff;
use App\Services\TariffService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TariffController extends Controller
{
    public function getPrice(Tariff $tariff, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|string',
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
