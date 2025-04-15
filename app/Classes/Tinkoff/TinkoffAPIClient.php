<?php

namespace App\Classes\Tinkoff;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

class TinkoffAPIClient
{
    const API_ENDPOINT = 'https://business.tbank.ru/openapi/api/v1/';
    const TOKEN = 't.KS4xB8p8qQFag7Yex4CdoEiSVItgeMpFLlbF1jRgFe6t5zElewo9lxybnKfZNYsx-74nXcIRAO2g_tYu8Nib-g';
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

    public function sendInvoice($data): ?array
    {
        if (empty($data['accountNumber'])) {
            $data['accountNumber'] = self::ACCOUNT_NUMBER;
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
