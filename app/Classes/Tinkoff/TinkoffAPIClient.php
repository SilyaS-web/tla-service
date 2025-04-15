<?php

namespace App\Classes\Tinkoff;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

class TinkoffAPIClient
{
    const API_ENDPOINT = 'https://business.tbank.ru/openapi/sandbox/secured/api/v1';
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
            $response = Http::withToken(self::TOKEN)->post(self::API_ENDPOINT . '/payment/ruble-transfer/pay', $data);
            return $response->successful();
        } catch (GuzzleException $e) {
            Log::error('TBank API error: ' . $e->getMessage());

            return false;
        }
    }

    public function sendInvoice($data): ?stdClass
    {
        if (empty($data['from'])) {
            $data['from'] = [
                'accountNumber' => self::ACCOUNT_NUMBER,
            ];
        }

        try {
            $response = Http::withToken(self::TOKEN)->post(self::API_ENDPOINT . '/invoice/send', $data);
            return $response->json();
        } catch (GuzzleException $e) {
            Log::error('TBank API error: ' . $e->getMessage());
        }

        return null;
    }
}
