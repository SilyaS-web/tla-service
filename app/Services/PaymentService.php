<?php

namespace App\Services;

use App;
use App\Classes\Tinkoff\TinkoffAPIClient;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use JustCommunication\TinkoffAcquiringAPIClient\API\InitRequest;
use JustCommunication\TinkoffAcquiringAPIClient\Exception\TinkoffAPIException;
use JustCommunication\TinkoffAcquiringAPIClient\TinkoffAcquiringAPIClient;

class PaymentService
{
    public static function getPaymentLink(int $user_id, int $price, string $description, string $type = Payment::TARIFF_TYPE, int $tariff_id = null, $from_landing = false): string
    {
        $payment = Payment::create([
            'user_id' => $user_id,
            'price' => $price,
            'type' => $type,
            'tariff_id' => $tariff_id,
        ]);

        $client = new TinkoffAcquiringAPIClient(config('tbank.terminal_key'), config('tbank.secret'));
        $initRequest = new InitRequest($price, $payment->id . '_' . App::isProduction());

        $notification_url = url('/');

        $params = http_build_query([
            'from_landing' => $from_landing,
            'type' => $type,
        ]);

        $success_url = url('/api/payment/' . $payment->id . '/success?') . $params;
        $fail_url = url('/api/payment/' . $payment->id . '/fail?') . $params;

        // необязательные параметры
        $initRequest
            ->setDescription($description)
            ->setNotificationURL($notification_url)
            ->setSuccessURL($success_url)
            ->setFailURL($fail_url);

        try {
            $response = $client->sendInitRequest($initRequest);
            $payment->update([
                'payment_id' => $response->getPaymentId()
            ]);

            return $response->getPaymentURL();
        } catch (TinkoffAPIException $e) {
            Log::channel('single')->info($e);
            return $fail_url;
        }
    }

    public static function initWithdraw(int $amount, User $user, $requisites): bool
    {
        $payment = Payment::create([
            'user_id' => $user->id,
            'price' => $amount,
            'type' => Payment::WITHDRAW,
        ]);
        $id = $payment->id . '_' . (int) App::isProduction();

        $data = [
            'id' => $id,
            'to' => $requisites,
            'purpose' => 'Выплата самозанятому по оказанию услуг',
            'amount' => $amount,
        ];
        $client = new TinkoffAPIClient();
        return $client->initWithdraw($data);
    }
}
