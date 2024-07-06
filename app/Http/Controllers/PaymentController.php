<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tariff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use JustCommunication\TinkoffAcquiringAPIClient\API\InitRequest;
use JustCommunication\TinkoffAcquiringAPIClient\Exception\TinkoffAPIException;
use JustCommunication\TinkoffAcquiringAPIClient\TinkoffAcquiringAPIClient;
use JustCommunication\TinkoffAcquiringAPIClient\API\GetStateRequest;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;


class PaymentController extends Controller
{
    public function successPayment(Payment $payment)
    {
        $state = $this->checkState($payment);
        if ($state == TPayment::STATUS_CONFIRMED) {
            return redirect()->route('tariff')->with('success', 'Тариф успешно оплачен');
        }

        return redirect()->route('tariff')->with('success', 'При получении платежа произошла ошибка');
    }

    public function failPayment(Payment $payment)
    {
        return redirect()->route('tariff')->with('success', 'При получении платежа произошла ошибка');
    }

    public function notificationsPayment(Payment $payment)
    {
        echo 'OK';
    }

    public function init(Tariff $tariff)
    {
        $user = Auth::user();
        $payment = Payment::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'price' => $tariff->price

        ]);

        $client = new TinkoffAcquiringAPIClient(config('tbank.terminal_key'), config('tbank.secret'));
        $initRequest = new InitRequest($tariff->price, $payment->id);

        // необязательные параметры
        $initRequest
            ->setDescription($tariff->title)
            ->setNotificationURL(url('/payment/' . $payment->id . '/notifications'))
            ->setSuccessURL(url('/payment/' . $payment->id . '/success'))
            ->setFailURL(url('/payment/' . $payment->id . '/fail'));

        try {
            $response = $client->sendInitRequest($initRequest);
            $payment->update([
                'payment_id' => $response->getPaymentId()
            ]);
            return redirect($response->getPaymentURL());
        } catch (TinkoffAPIException $e) {
            Log::channel('single')->info(json_encode($e));
            return redirect(url('/payment/' . $payment->id . '/fail'));
        }
    }

    public function checkState(Payment $payment)
    {
        $client = new TinkoffAcquiringAPIClient(config('tbank.terminal_key'), config('tbank.secret'));
        $payment_id = $payment->payment_id;
        $request = new GetStateRequest($payment_id);

        try {
            $response = $client->sendGetStateRequest($request);
            $status = $response->getStatus();
            $payment->update(['status' => $status]);
            return $status;
        } catch (TinkoffAPIException $e) {
            Log::channel('single')->info(json_encode($e));
            return response()->json(['status' => Payment::FAILED]);
        }
    }
}
