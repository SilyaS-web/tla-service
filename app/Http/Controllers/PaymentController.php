<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Project;
use App\Models\Seller;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\TgPhone;
use App\Models\User;
use App\Services\PhoneService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use JustCommunication\TinkoffAcquiringAPIClient\API\InitRequest;
use JustCommunication\TinkoffAcquiringAPIClient\Exception\TinkoffAPIException;
use JustCommunication\TinkoffAcquiringAPIClient\TinkoffAcquiringAPIClient;
use JustCommunication\TinkoffAcquiringAPIClient\API\GetStateRequest;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;


class PaymentController extends Controller
{
    public function successPayment(Payment $payment)
    {
        $from_landing = request()->input('from_landing', 0);
        $user = User::find($payment->user_id);
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
            if ($from_landing) {
                return redirect('adswap.ru')->with('success', 'Тариф успешно оплачен');
            }

            return redirect()->route('tariff')->with('success', 'Тариф успешно оплачен');
        }

        if ($from_landing) {
            return redirect('adswap.ru')->with('success', 'При получении платежа произошла ошибка');
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

    public function init(Tariff $tariff, $from_landing = false, $user_id = null)
    {
        $user = null;
        if (!$user_id) {
            $user = Auth::user();
        } else {
            $user = User::find($user_id);
        }

        $payment = Payment::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'price' => $tariff->price

        ]);

        $client = new TinkoffAcquiringAPIClient(config('tbank.terminal_key'), config('tbank.secret'));
        $initRequest = new InitRequest($tariff->price, $payment->id . 'test');

        $notification_url = url('/payment/' . $payment->id . '/notifications');
        $success_url = url('/payment/' . $payment->id . '/success?') .  ($from_landing ? 'from_landing=1' : '');
        $fail_url = url('/payment/' . $payment->id . '/fail?') .  ($from_landing ? 'from_landing=1' : '');

        // необязательные параметры
        $initRequest
            ->setDescription($tariff->title)
            ->setNotificationURL($notification_url)
            ->setSuccessURL($success_url)
            ->setFailURL($fail_url);

        try {
            $response = $client->sendInitRequest($initRequest);
            $payment->update([
                'payment_id' => $response->getPaymentId()
            ]);
            return redirect($response->getPaymentURL());
        } catch (TinkoffAPIException $e) {
            Log::channel('single')->info($e);
            return redirect($fail_url);
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

    public function regFromPayment(Tariff $tariff)
    {
        $validator = Validator::make(request()->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $validated = $validator->validated();

        $phone = PhoneService::format($validated['phone']);
        $user = User::where([['phone', '=',  $phone]])->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Аккаунт с таким номером телефона не найден')->withInput();
        }

        $this->init($validated['tariff_id'], true, $user->id);
    }
}
