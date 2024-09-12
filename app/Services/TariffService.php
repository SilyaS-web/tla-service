<?php

namespace App\Services;

use App\Models\Tariff;

class TariffService
{
    public static function getPrice(String $tariff_type, Int $selected_quantity)
    {
        if (!isset(Tariff::PRICE_CONDITIONS[$tariff_type])) {
            return false;
        }

        if (!isset(Tariff::MINIMAL_QUANTITY[$tariff_type]) && Tariff::MINIMAL_QUANTITY[$tariff_type] > $selected_quantity) {
            return false;
        }

        $price_per_piece = 0;
        foreach (Tariff::PRICE_CONDITIONS[$tariff_type] as $tariff_quantity => $price) {
            if ($tariff_quantity <= $selected_quantity) {
                $price_per_piece = $price;
            }
        }

        return $price_per_piece * $selected_quantity;
    }
}
