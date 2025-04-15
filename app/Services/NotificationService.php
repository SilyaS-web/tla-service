<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Work;

class NotificationService
{
    public static function send(string $text, string $sender_role, Work $work, $title = 'Новое сообщение'): void
    {
        $user = $work->getPartnerUser($sender_role);
        Notification::create([
            'user_id' => $user->id,
            'work_id' => $work->id,
            'type' => $title,
            'text' => $text,
        ]);
        TgService::notify($user->tgPhone->chat_id, $text);
    }
}
