<?php

namespace App\Services;

use App\Models\ReferralCode;
use App\Models\ReferralUser;

class ReferralService
{
    public static function ref($user_id, $code, $role)
    {
        $referralCode = ReferralCode::where("code", $code)->first();
        if ($referralCode) {
            ReferralUser::create([
                'referral_code_id' => $referralCode->id,
                'user_id' => $user_id,
                'role' => $role,
            ]);
        }
    }
}
