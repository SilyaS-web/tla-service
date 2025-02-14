<?php

namespace App\Services;

use App\Models\Seller;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\User;
use Carbon\Carbon;

class SellerService
{
    public static function store(User $user, array $data): Seller
    {
        $is_agent = false;

        if ($data['role'] == 'agent') {
            $is_agent = true;
        }

        $seller = Seller::create([
            'user_id' => $user->id,
            'is_agent' => $is_agent,
        ]);

        $tariff = Tariff::where('is_start', 'true')->where('is_active', true)->first();

        if ($tariff) {
            SellerTariff::create([
                'user_id' => $user->id,
                'tariff_id' => $tariff->id,
                'type' => $tariff->type,
                'quantity' => $tariff->quantity,
                'finish_date' => Carbon::now()->addDays($tariff->period),
                'activation_date' => Carbon::now(),
            ]);
        }

        return $seller;
    }
}
