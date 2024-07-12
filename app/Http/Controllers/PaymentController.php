<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\SellerTariff;
use App\Models\Tariff;
use Carbon\Carbon;
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
        $user = Auth::user();
        $state = $this->checkState($payment);
        if ($state == TPayment::STATUS_CONFIRMED) {
            $tariff = Tariff::find($payment->tariff_id);

            $seller_start_tariff = $user->getActiveTariffByGroup(1);
            if ($tariff->type == Project::FEEDBACK && $user->getActiveTariffByGroup(1)) {
                $seller_start_tariff->delete();
            }

            $seller_tariff = $user->getActiveTariffByGroup($tariff->group_id);
            if ($seller_tariff) {
                $finish_date = new Carbon($seller_tariff->finish_date);
                $seller_tariff->update(['quantity' => $seller_tariff->quantity + $tariff->quantity, 'finish_date' => $finish_date->addDays($tariff->period)]);
            } else {
                SellerTariff::create([
                    'user_id' => Auth::user()->id,
                    'tariff_id' => $tariff->id,
                    'type' => $tariff->type,
                    'quantity' => $tariff->quantity,
                    'finish_date' => Carbon::now()->addDays($tariff->period),
                    'activation_date' => Carbon::now(),
                ]);
            }

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
        $initRequest = new InitRequest($tariff->price, $payment->id . 'test');

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
            Log::channel('single')->info($e);
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
            Log::channel('single')->info($e);
            return response()->json(['status' => Payment::FAILED]);
        }
    }
}
