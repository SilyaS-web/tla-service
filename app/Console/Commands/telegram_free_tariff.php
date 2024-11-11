<?php

namespace App\Console\Commands;

use App\Models\TgPhone;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class telegram_free_tariff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:telegram_free_tariff';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Делает рассылку для пользователей telegram';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users_without_projects = User::where('role', 'seller')->where('status', 1)->doesntHave('projects')->get();
        foreach ($users_without_projects as $user) {
            $tg_phone = $user->tgPhone;
            $token = $user->createToken('Bearer');
            $plain_text_token = $token->plainTextToken;

            $api_key = config('telegram.main_bot_api_key');
            $message_text = "Добавьте товар, чтобы уже сегодня получить предложения от блогеров\\.

Более того, если вы нажмете кнопку снизу, мы с радостью продлим тариф \"Пробный\"

Добавить товар";
            $data = [
                'chat_id' => $tg_phone->chat_id,
                'text' => $message_text,
                'parse_mode' => 'MarkdownV2',
                'disable_web_page_preview' => true,
                'reply_markup' => [
                    'inline_keyboard' => [
                        [
                            [
                                'text' => "Добавить товар",
                                'url' => config('app.url') . '?token=' . $plain_text_token
                            ],
                        ]
                    ]
                ]
            ];
            Log::info("[telegram_free_tariff] data " . json_encode($data));

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
            Log::info("[telegram_free_tariff] response " . $response);

            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
        }
    }
}
