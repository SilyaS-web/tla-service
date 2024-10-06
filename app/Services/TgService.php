<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class TgService
{
    public static function sendResetPassword($chat_id, $password)
    {
        if (!App::environment('production')) {
            Log::info("[sendResetPassword] chat_id " . $chat_id . " password " . $password);
            return true;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '195.24.67.70/reset-password',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "chatId": ' . $chat_id . ',
            "newPassword": "' . $password . '"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return $httpcode == 200 ? true : false;
    }

    public static function notify($chat_id, $text)
    {
        if (!App::environment('production')) {
            Log::info("[notify] chat_id " . $chat_id . " text " . $text);
            return true;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => '195.24.67.70/notify',
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

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return $httpcode == 200 ? true : false;
    }

    public static function sendForm($message_text) {
        if (!App::environment('production')) {
            Log::info("[sendForm] message_text " . $message_text);
            return true;
        }

        $chat_id = -4100606972;
        $api_key = '7105243036:AAH1MvLxX-5pZiAoemd6LJg9idpoulpZRjQ';

        $data = [
            'chat_id' => $chat_id,
            'text' => $message_text
        ];
        $curl = curl_init();
        $url = 'https://api.telegram.org/bot' . $api_key . '/sendMessage';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $httpcode == 200 ? "success" : false;
    }

    public static function sendPayment($message_text) {
        if (!App::environment('production')) {
            Log::info("[sendPayment] message_text " . $message_text);
            return true;
        }

        $chat_id = -1002234196530;
        $api_key = '7309448724:AAHhuen7LBkUBuQJM0N2s7KZlXkW_UdlRzw';

        $data = [
            'chat_id' => $chat_id,
            'text' => $message_text
        ];
        $curl = curl_init();
        $url = 'https://api.telegram.org/bot' . $api_key . '/sendMessage';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $httpcode == 200 ? "success" : false;
    }

    public static function sendModeration($message_text) {
        if (!App::environment('production')) {
            Log::info("[sendModeration] message_text " . $message_text);
            return true;
        }

        $chat_id = -1002155045570;
        $api_key = '7307095293:AAGyU3CiAReZAbOXS6pyOPatNTSE3eI3UbQ';

        $data = [
            'chat_id' => $chat_id,
            'text' => $message_text
        ];
        $curl = curl_init();
        $url = 'https://api.telegram.org/bot' . $api_key . '/sendMessage';

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $httpcode == 200 ? "success" : false;
    }
}
