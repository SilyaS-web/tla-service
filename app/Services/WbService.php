<?php

namespace App\Services;

class WbService
{
    public static function getFeedbackCounters($nm)
    {
        $ch = curl_init();

        $ch = curl_init();
        $url = 'https://card.wb.ru/cards/detail?nm=' . $nm . '&appType=1&locale=ru&lang=ru&curr=rub&dest=1';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response = json_decode($response);
        $product = ($httpcode == 200 && !empty($response->data->products)) ? $response->data->products[0] : false;

        return $product;
    }

    public static function getProductInfo(int $product_nm)
    {
        $r = $product_nm;
        $n = ~~($r / 1e5);
        $a = ~~($r / 1e3);
        $o = self::getHost($n);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://$o/vol$n/part$a/$r/info/ru/card.json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code != 200) {
            return false;
        }

        $card = json_decode($response);
        return $card;
    }

    public static function getHost($e)
    {
        $t = "01";
        switch (!0) {
            case $e >= 0 && $e <= 143:
                $t = "01";
                break;
            case $e >= 144 && $e <= 287:
                $t = "02";
                break;
            case $e >= 288 && $e <= 431:
                $t = "03";
                break;
            case $e >= 432 && $e <= 719:
                $t = "04";
                break;
            case $e >= 720 && $e <= 1007:
                $t = "05";
                break;
            case $e >= 1008 && $e <= 1061:
                $t = "06";
                break;
            case $e >= 1062 && $e <= 1115:
                $t = "07";
                break;
            case $e >= 1116 && $e <= 1169:
                $t = "08";
                break;
            case $e >= 1170 && $e <= 1313:
                $t = "09";
                break;
            case $e >= 1314 && $e <= 1601:
                $t = "10";
                break;
            case $e >= 1602 && $e <= 1655:
                $t = "11";
                break;
            case $e >= 1656 && $e <= 1919:
                $t = "12";
                break;
            case $e >= 1920 && $e <= 2045:
                $t = "13";
                break;
            case $e >= 2046 && $e <= 2189:
                $t = "14";
                break;
            case $e >= 2090 && $e <= 2405:
                $t = "15";
                break;
            case $e >= 2406 && $e <= 2621:
                $t = "16";
                break;
            default:
                $t = "17";
        }
        return "basket-$t.wbbasket.ru";
    }
}
