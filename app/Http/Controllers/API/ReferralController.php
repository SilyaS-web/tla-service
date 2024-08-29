<?php

namespace App\Http\Controllers\API;

use App\Exports\ReferralExports;
use App\Exports\ReferralWithPaymentExports;
use App\Http\Resources\ReferralCodeResource;
use App\Models\ReferralCode;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
    public function index()
    {
        $referral_codes = ReferralCode::all();

        $data = [
            'referral_codes' => ReferralCodeResource::collection($referral_codes),
        ];

        return response()->json($data)->setStatusCode(200);
    }

    public function export(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'referral_code_id' => 'numeric|exists:referral_codes,id',
            'payments' => 'boolean|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        if ($validated['payments']) {
            return Excel::download(new ReferralWithPaymentExports($validated['referral_code_id']), 'referals.xlsx');
        }

        return Excel::download(new ReferralExports($validated['referral_code_id']), 'referals.xlsx');
    }
}
