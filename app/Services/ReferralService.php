<?php

namespace App\Services;

use App\Models\ReferralCode;
use App\Models\ReferralUsers;

class ReferralService
{
    public static function ref($user_id, $code)
    {
        $referralCode = ReferralCode::where("code", $code)->first();
        if ($referralCode) {
            ReferralUsers::create([
                'referral_code_id' => $referralCode->id,
                'user_id' => $user_id
            ]);
        }
    }
}
