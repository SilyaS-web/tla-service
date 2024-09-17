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

    public static function getOrdersStats($nm)
    {
        $ch = curl_init();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://anabar.ai/api/chrome/v1/product/wb/' . $nm);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: */*',
            'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'origin: https://www.wildberries.ru',
            'priority: u=1, i',
            'referer: https://www.wildberries.ru/catalog/' . $nm . '/detail.aspx',
            'sec-ch-ua: "Google Chrome";v="125", "Chromium";v="125", "Not.A/Brand";v="24"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'sec-fetch-dest: empty',
            'sec-fetch-mode: cors',
            'sec-fetch-site: cross-site',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
        ]);
        curl_setopt($ch, CURLOPT_COOKIE, '_ym_uid=1715183653727565142; _ym_d=1715183653; _ymab_param=tf7wZFLDwVBcQyli3tGkT4AH8FV2XqRvd2LdmTJirQRRWS6OZndTxIFRkfZ_r3R5HsOmGU7rBvwOwgkFCthtJhUzDH4; _ct_server=2600000000047472551; remember_token=218237|e9e573a6b3907b2dd8aa8b08371f48a4dc16dc59de313f9f365b4b09a7888182907281f316cf23bc91d57c86ad31fbeef41e0720133e3067bb588a11469e28c4; _hjSessionUser_3289482=eyJpZCI6IjFiMGY0ODQ3LTM0MGItNTY3ZC04ZTFlLWQyZTFhMjI1MmMwNiIsImNyZWF0ZWQiOjE3MTUxODQyMzQ4NjMsImV4aXN0aW5nIjp0cnVlfQ==; session=.eJwljktqxEAMRO_S6xjUUv_kyxi5JZGBxAnu8WrI3dNmdkVBvXqvsPlp4zOsLl_DPsL20LCGwtq6dqyAykC1ZmmdXHonRk7NCyqqKwBESliwRZibqN0ZISkJg1Kx3XPxvURLwLlmU2NpWDmbe2SwXLmCUNZIM5YGzVWIUrhFxrhMN3mGNdaYc2uTPPtfO7_lsGP2z_O6lYeN8fg53uoG6sSyLwK8Lwk1Lq0WWKjrPn-z1O43_hp2vhcYG1INf_8ABkxz.ZlUq6A.0B3D4AtxjQPBx2hgXN5OR2F-HBA');

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $result = [];
        if ($httpcode != 200) {
            $result = [
                'orders' => 0,
                'earnings' => 0,
                'prices_history' => [],
                'orders_history' => [],
            ];
        }

        $result = $response;
        return json_decode($result, true);
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
