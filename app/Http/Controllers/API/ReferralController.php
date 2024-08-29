<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ReferralCodeResource;
use App\Models\ReferralCode;
use App\Http\Controllers\Controller;

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
}
