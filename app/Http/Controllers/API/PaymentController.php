<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\User;
use App\Services\PhoneService;
use App\Services\TariffService;
use App\Services\TgService;
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
    public function index(Request $request)
    {
        $payments = PaymentResource::collection(Payment::all());
        $data = [
            'payments' => $payments,
        ];
        return response()->json($data)->setStatusCode(200);
    }

    public function successPayment(Payment $payment)
    {
        $from_landing = request()->input('from_landing', null);
        $user = User::find($payment->user_id);
        $state = $this->checkState($payment);
        if ($state == TPayment::STATUS_CONFIRMED) {
            $tariff = Tariff::find($payment->tariff_id);
            $message_text = "Новая оплата\n\nИмя: " . $user->name . "\nТелефон: " . $user->phone . "\nТариф: " . $tariff->title . " — ". $tariff->tariffGroup->title . "\nСумма: " . ($tariff->price / 100) . " руб.\nID в банке: " . $payment->payment_id;
            TgService::sendPayment($message_text);

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
                return redirect('https://adswap.ru/#successful-payment');
            }

            return redirect('/')->setStatusCode(200);
        }

        if ($from_landing) {
            return redirect('https://adswap.ru');
        }

        return redirect('/')->setStatusCode(400);
    }

    public function failPayment(Payment $payment)
    {
        $from_landing = request()->input('from_landing', null);
        if ($from_landing) {
            return redirect('https://adswap.ru');
        }

        return redirect()->route('tariff')->with('success', 'При получении платежа произошла ошибка');
    }

    public function notificationsPayment(Payment $payment)
    {
        echo 'OK';
    }

    public function init(Tariff $tariff, Int $selected_quantity = null, $from_landing = false, $user_id = null, $degug_price = null)
    {
        $price = $tariff->price;
        $quantity = $tariff->quantity;

        if (!$selected_quantity || $selected_quantity <= 10) {
            $validator = Validator::make(request()->all(), [
                'quantity' => 'numeric|nullable',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $validated = $validator->validated();

            if ($selected_quantity || isset($validated['quantity'])) {
                $quantity = $validated['quantity'] ?? $selected_quantity;
                $price = TariffService::getPrice($tariff->type, $quantity) * 100;
            }
        }

        $user = null;
        if (!$user_id) {
            $user = Auth::user();
        } else {
            $user = User::find($user_id);
        }

        $payment = Payment::create([
            'user_id' => $user->id,
            'tariff_id' => $tariff->id,
            'price' => $price,
            'quantity' => $quantity,
        ]);

        $price = $degug_price ?? $price;
        $description = $degug_price != null ? 'Тестовый платёж' : $tariff->title;

        $client = new TinkoffAcquiringAPIClient(config('tbank.terminal_key'), config('tbank.secret'));
        $initRequest = new InitRequest($price, $payment->id . '_' . $tariff->id);

        $notification_url = url('/');
        $success_url = url('/api/payment/' . $payment->id . '/success') .  ($from_landing ? 'from_landing=1' : '');
        $fail_url = url('/api/payment/' . $payment->id . '/fail') .  ($from_landing ? 'from_landing=1' : '');

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

            if ($from_landing) {
                return $response->getPaymentURL();
            }

            return response()->json(['link' => $response->getPaymentURL()])->setStatusCode(200);
        } catch (TinkoffAPIException $e) {
            Log::channel('single')->info($e);

            if ($from_landing) {
                return $fail_url;
            }

            return response()->json(['message' => 'Произошла ошибка на стороне банка'])->setStatusCode(400);
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
            'quantity' => 'numeric|required',
            'phone' => 'string|required',
        ]);

        if ($validator->fails()) {
            return redirect('https://adswap.ru');
        }

        $validated = $validator->validated();

        $phone = PhoneService::format($validated['phone']);
        $user = User::where([['phone', '=',  $phone]])->first();

        if (!$user) {
            return redirect()->route('login')->with('success', 'Аккаунт с таким номером телефона не найден')->withInput();
        }

        $redirect_url = $this->init($tariff, $validated['quantity'], true, $user->id);
        return redirect($redirect_url);
    }

    public function debugPayment(Tariff $tariff)
    {
        $redirect_url = $this->init($tariff, true, null, 1000);
        return redirect($redirect_url);
    }
}
