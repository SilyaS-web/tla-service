<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class TgService
{
    public static function sendResetPassword($chat_id, $password)
    {
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => '195.24.67.70:5000/reset-password',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //     "chatId": ' . $chat_id . ',
        //     "newPassword": "' . $password . '"
        // }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Content-Type: application/json'
        //     ),
        // ));

        // Log::info("chat_id " . $chat_id);
        // Log::info("text " . $password);

        // $response = curl_exec($curl);
        // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // curl_close($curl);
        // return $httpcode == 200 ? true : false;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '195.24.67.70:5000/notify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
    "chatId": 6911168932,
    "text": "Гандон"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic YXNleHByZXNzOk5ld0FjY2VzczIwMjM='
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public static function notify($chat_id, $text)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '195.24.67.70:5000/notify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "chatId": ' . $chat_id . ',
            "text": "' . $text . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        Log::info("chat_id " . $chat_id);
        Log::info("text " . $text);

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return $httpcode == 200 ? true : false;
    }
}
