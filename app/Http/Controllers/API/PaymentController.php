<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::get();
        $data = [
            'payments' => $payments,
        ];
        return response()->json($data)->setStatusCode(200);
    }
}
