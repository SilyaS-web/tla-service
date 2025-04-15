<?php

namespace App\Classes\Tinkoff;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TinkoffAPIClient
{
    const API_ENDPOINT = 'https://business.tbank.ru';
    const TOKEN = 'TBankSandboxToken';
    const ACCOUNT_NUMBER = '40802810600002050260';
    private Client $client;


    public function initWithdraw($data): bool
    {
        if (empty($data['from'])) {
            $data['from'] = [
                'accountNumber' => self::ACCOUNT_NUMBER,
            ];
        }

        try {
            $response = Http::withToken(self::TOKEN)->post(self::API_ENDPOINT . '/openapi/sandbox/secured/api/v1/payment/ruble-transfer/pay', $data);
            return $response->successful();
        } catch (GuzzleException $e) {
            Log::error('TBank API error: ' . $e->getMessage());

            return false;
        }
    }
}
