<?php

namespace App\Services;

class PhoneService
{
    public static function format($phone): array|string
    {
        $formatted_phone = str_replace(['(', ')', ' ', '-'], '', $phone);
        if (isset($formatted_phone[0])) {
            if ($formatted_phone[0] == '7') {
                $formatted_phone = '+' . $formatted_phone;
            } else if ($formatted_phone[0] == '8') {
                $formatted_phone[0] = '7';
                $formatted_phone = '+' . $formatted_phone;
            }
        }

        return $formatted_phone;
    }
}
