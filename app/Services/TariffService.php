<?php

namespace App\Services;

use App\Models\Project;
use App\Models\SellerTariff;
use App\Models\Tariff;
use App\Models\User;
use Carbon\Carbon;
use JustCommunication\TinkoffAcquiringAPIClient\Model\Payment as TPayment;

class TariffService
{
    public static function add(Tariff $tariff, User $user, int $payment_id): void
    {
        $message_text = "Новая оплата\n\nИмя: " . $user->name . "\nТелефон: " . $user->phone . "\nТариф: " . $tariff->title . " — " . $tariff->tariffGroup->title . "\nСумма: " . ($tariff->price / 100) . " руб.\nID в банке: " . $payment_id;
        TgService::sendPayment($message_text);

        $seller_start_tariff = $user->getActiveTariffByGroup(1);
        if ($tariff->type == Project::BARTER && $user->getActiveTariffByGroup(1)) {
            $seller_start_tariff->delete();
        }

        $seller_tariff = $user->getActiveTariffByGroup($tariff->group_id);
        if ($seller_tariff) {
            $finish_date = new Carbon($seller_tariff->finish_date);
            $seller_tariff->update(['quantity' => $seller_tariff->quantity + $tariff->quantity, 'finish_date' => $finish_date->addDays($tariff->period)]);
        } else {
            SellerTariff::create([
                'user_id' => $user->id,
                'tariff_id' => $tariff->id,
                'type' => $tariff->type,
                'quantity' => $tariff->quantity,
                'finish_date' => Carbon::now()->addDays($tariff->period),
                'activation_date' => Carbon::now(),
            ]);
        }
    }
}
