<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TgPhone;
use App\Services\TgService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function distribute(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'from_chat_id' => 'required|numeric',
            'message_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        Log::info('from_chat_id: ' . $validated['from_chat_id'] . ' message_id: ' . $validated['message_id']);

        $tg_phones = TgPhone::whereHas('user', function (Builder $query) {
            $query->where('role', 'blogger');
        })->get();

        $error = false;
        $params = [
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        [
                            'text' => 'Подробнее',
                            'url' => 'https://t.me/adswap_blogger/103'
                        ],
                    ]
                ]
            ]
        ];
        foreach ($tg_phones as $phone) {
            if (!TgService::copyMessage($phone->chat_id, $validated['from_chat_id'], $validated['message_id'], $params)) {
                $error = true;
            };
        }
        return response()->json()->setStatusCode(!$error ? 200 : 400);
    }
}
