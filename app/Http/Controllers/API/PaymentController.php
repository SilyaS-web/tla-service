<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

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
}
