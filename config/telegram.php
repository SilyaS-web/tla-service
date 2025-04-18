<?php

use Illuminate\Support\Facades\App;

return [
    'main_bot_api_key' => env('TELEGRAM_API_KEY', null),
    'dev_bot_api_key' => env('TELEGRAM_DEV_API_KEY', null),
    'forms_bot_api_key' => env('FORMS_BOT_API_KEY', null),
    'payments_bot_api_key' => env('PAYMENTS_BOT_API_KEY', null),
    'moderation_bot_api_key' => env('MODERATION_BOT_API_KEY', null),
    'errors_group_id' => -4572871767,
];
