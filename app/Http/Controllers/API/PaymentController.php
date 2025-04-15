<?php

namespace App\Http\Controllers\API;

use App;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\InitPaymentRequest;
use App\Http\Requests\Payments\StoreInvoiceRequest;
use App\Http\Requests\Payments\WithdrawRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Models\Requisites;
use App\Services\BalanceService;
use App\Services\InvoiceService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use App\Models\Tariff;
use App\Models\User;
use App\Services\PhoneService;
use App\Services\TariffService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use JustCommunication\TinkoffAcquiringAPIClient\Exception\TinkoffAPIException;
use JustCommunication\TinkoffAcquiringAPIClient\TinkoffAcquiringAPIClient;
use JustCommunication\TinkoffAcquiringAPIClient\API\GetStateRequest;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;

class PaymentController extends Controller
{
    public function index(): JsonResponse
    {
        $payments = PaymentResource::collection(Payment::all());
        $data = [
            'payments' => $payments,
        ];
        return response()->json($data)->setStatusCode(200);
    }

    public function successPayment(Payment $payment)
    {
        $from_landing = request()->input('from_landing');
        $type = request()->input('type');
        $user = User::find($payment->user_id);
        $state = $this->checkState($payment);
        if ($payment->processed && ($state == TPayment::STATUS_CONFIRMED || !App::isProduction())) {
            switch ($type) {
                case Payment::TARIFF_TYPE:
                    $tariff = Tariff::find($payment->tariff_id);
                    TariffService::add($tariff, $user, $payment->id);
                    break;
                case Payment::TOP_UP_TYPE:
                    BalanceService::add($payment->price, $user, $payment->id);
                    break;
                default:
                    Log::channel('single')->info('Неизвестный тип оплаты :' . $type);
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
        $from_landing = request()->input('from_landing');
        if ($from_landing) {
            return redirect('https://adswap.ru');
        }

        return redirect()->route('tariff')->with('success', 'При получении платежа произошла ошибка');
    }

    public function notificationsPayment(Payment $payment): void
    {
        echo 'OK';
    }

    public function initTariffPayment(Tariff $tariff, User $user = null, $from_landing = false, $debug_price = null): JsonResponse
    {
        $price = $tariff->price;

        if (!$user) {
            $user = Auth::user();
        }

        $price = $debug_price ?? $price;
        $description = $debug_price != null ? 'Тестовый платёж' : $tariff->title;

        $link = PaymentService::getPaymentLink($user->id, $price, $description, Payment::TARIFF_TYPE, $tariff->id, $from_landing);
        return response()->json(['link' => $link])->setStatusCode(200);
    }

    public function initBalancePayment(InitPaymentRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $user = Auth::user();

        $description = 'Тестовый платёж баланса';
        $link = PaymentService::getPaymentLink($user->id, $validated['price'], $description, Payment::TOP_UP_TYPE);
        return response()->json(['link' => $link])->setStatusCode(200);
    }

    public function checkState(Payment $payment): JsonResponse|string
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
            'phone' => 'string|required',
        ]);

        if ($validator->fails()) {
            return redirect('https://adswap.ru');
        }

        $validated = $validator->validated();

        $phone = PhoneService::format($validated['phone']);
        $user = User::where([['phone', '=', $phone]])->first();

        if (!$user) {
            return redirect()->route('login')->with('success', 'Аккаунт с таким номером телефона не найден')->withInput();
        }

        $redirect_url = $this->initTariffPayment($tariff, $user, true);
        return redirect($redirect_url);
    }

    public function debugPayment(Tariff $tariff)
    {
        $redirect_url = $this->initTariffPayment($tariff, null, false, 1000);
        return redirect($redirect_url);
    }

    public function withdraw(WithdrawRequest $request, User $user): JsonResponse
    {
        $validated = $request->validated();
        if ($user->balance < $validated['amount']) {
            return response()->json(['result' => 'Сумма превышает баланс'], 400);

        }

        $requisites = Requisites::where('user_id', $user->id)->first();
        if (!$requisites) {
            return response()->json(['result' => 'Заполните реквизиты'], 400);
        }

        $requisites = $requisites->toArray();
        unset($requisites['user_id']);

        if (PaymentService::initWithdraw($validated['amount'], $user, $requisites)) {
            BalanceService::withdraw($validated['amount'], $user);
            return response()->json(['result' => 'Выплата поставлена в очередь']);
        }

        return response()->json(['result' => 'Не удалось вывести средства, обратитесь в поддержку'], 400);
    }

    public function initInvoice(StoreInvoiceRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $invoice = InvoiceService::store($validated);
        $result = InvoiceService::send($invoice);
        if ($result) {
            InvoiceService::update($invoice, [
                'invoice_id' => $result->invoiceId,
                'pdf_url' => $invoice->pdfUrl,
                'incoming_invoice_url' => $invoice->incomingInvoiceUrl,
            ]);
            return response()->json(['result' => $result]);
        }

        return response()->json(['result' => 'Не удалось выставить счёт, обратитесь в поддержку'], 400);
    }
}
