<?php

namespace App\Services;

use App\Models\User;

class BalanceService
{
    public static function add(int $price, User $user, int $payment_id): void
    {
        $message_text = "Пополнение баланса\n\nИмя: " . $user->name . "\nТелефон: " . $user->phone . "\nСумма: " . ($price / 100) . " руб.\nID в банке: " . $payment_id;
        TgService::sendPayment($message_text);

        $user->balance += $price;
        $user->save();
    }

    public static function withdraw(int $amount, User $user): void
    {
        $message_text = "Вывод средств \n\nИмя: " . $user->name . "\nТелефон: " . $user->phone . "\nСумма: " . ($amount / 100) . " руб.";
        TgService::sendPayment($message_text);

        $user->balance -= $amount;
        $user->save();
    }
}
