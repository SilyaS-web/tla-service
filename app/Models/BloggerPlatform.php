<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloggerPlatform extends Model
{
    use HasFactory;

    public const YOUTUBE = 'Youtube';
    public const INSTAGRAM = 'Instagram';
    public const VK = 'VK';
    public const TELEGRAM = 'Telegram';

    const PLATFORM_TYPES = [
        self::YOUTUBE,
        self::INSTAGRAM,
        self::VK,
        self::TELEGRAM,
    ];

    const PLATFORM_ICON_URLS = [
        self::YOUTUBE => 'img/youtube-colored-icon.svg',
        self::INSTAGRAM => 'img/inst-icon.svg',
        self::VK => 'img/vk-icon.svg',
        self::TELEGRAM => 'img/telegram-icon.svg',
    ];

    protected $fillable = [
        'blogger_id',
        'name',
        'subscriber_quantity',
        'coverage',
        'link',
        'engagement_rate',
        'cost_per_mille',
        'icon_url',
    ];

    public function blogger()
    {
        return $this->belongsTo(Blogger::class, 'id', 'blogger_id');
    }

    public function getIconURL()
    {
        return asset(self::PLATFORM_ICON_URLS[$this->name]);
    }

    public static function getLowerPlatforms() {
        $platform_names = [];
        foreach (self::PLATFORM_TYPES as $platform_type) {
            $platform_names[] = strtolower($platform_type);
        }

        return $platform_names;
    }
}
