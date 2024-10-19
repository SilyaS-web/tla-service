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

        $data = [
            'chatId' => $chat_id,
            'text' => $text
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => '195.24.67.70/notify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);
        return $http_code == 200 ? true : false;
    }

    public static function sendMessage($chat_id, $text, $params = [])
    {
        $api_key = config('telegram.main_bot_api_key');
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
        ];

        if (!empty($params)) {
            $data = array_merge($data, $params);
        }
        Log::info("[sendMessage] data " . json_encode($data));

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
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        Log::info("[sendMessage] response " . $response);

        return $http_code == 200 ? "success" : false;
    }

    public static function sendForm($message_text)
    {
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

    public static function sendPayment($message_text)
    {
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

    public static function sendModeration($message_text)
    {
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

    public static function sendModerationMessage($status, $phone, $password, $token, $chat_id)
    {
        $api_key = config('telegram.main_bot_api_key');
        $new_phone = str_replace("+", "\\+", $phone);
        if ($status >= 0) {
            $message_text = "🔑 Данные для доступа к сервису

Ссылка для входа: https://lk\\.adswap\\.ru/
Логин: \`$new_phone\`
Пароль: \`$password\`

Авторизуйтесь в сервисе и посмотрите раздел [инструкции](https://adswap.ru/instructions)\\.
Если у вас остались вопросы, напишите нам в чат поддержки по [ссылке](https://t.me/adswap_admin)\\.";
            $data = [
                'chat_id' => $chat_id,
                'text' => $message_text,
                'parse_mode' => 'MarkdownV2',
                'disable_web_page_preview' => true,
                'reply_markup' => [
                    'inline_keyboard' => [
                        [
                            [
                                'text' => "Перейти на сайт",
                                'url' => config('app.url') . '?token=' . $token
                            ],
                        ]
                    ]
                ]
            ];
            Log::info("[sendModerationMessage] data " . json_encode($data));
        } else {
            $data = [
                'chat_id' => $chat_id,
                'text' => 'Ваш аккаунт не прошел модерацию',
            ];
        }

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
        Log::info("[sendModerationMessage] response " . $response);

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $httpcode == 200 ? "success" : false;
    }
}
