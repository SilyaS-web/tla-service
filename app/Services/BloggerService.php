<?php

namespace App\Services;

use App\Models\Blogger;
use App\Models\BloggerPlatform;
use App\Models\Platform;
use App\Models\User;

class BloggerService
{
    public static function store(User $user, array $platforms): Blogger
    {
        $blogger = Blogger::create([
            'user_id' => $user->id,
        ]);

        foreach ($platforms as $blogger_platform) {
            if (!empty($blogger_platform['link'])) {
                $platform = Platform::query()->where('title', $blogger_platform['name'])->first();

                if (!$platform) {
                    TgService::sendMessage($user->tgPhone->chat_id, 'Платформа ' . $blogger_platform['name'] . ' не найдена');
                    throw new \Exception('Платформа ' . $blogger_platform['name'] . ' не найдена');
                }

                BloggerPlatform::create([
                    'blogger_id' => $blogger->id,
                    'platform_id' => $platform->id,
                    'link' => $blogger_platform['link'],
                ]);
            }
        }

        TgService::sendModeration($user->name . ' оставил заявку на модерацию');
        return $blogger;
    }
}
