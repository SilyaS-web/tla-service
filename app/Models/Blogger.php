<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'sex',
        'is_achievement',
        'gender_ratio',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function platforms()
    {
        return $this->hasMany(BloggerPlatform::class, 'blogger_id', 'id');
    }

    public function getSubscribers()
    {
        $quantity = $this->platforms()->max('subscriber_quantity');
        return $quantity;
    }

    public function getCoverage()
    {
        $coverage = $this->platforms()->avg('coverage');
        return $coverage;
    }

    public function getER()
    {
        $engagement_rate = $this->platforms()->avg('engagement_rate');
        return $engagement_rate;
    }

    public function getCPM()
    {
        $cost_per_mille = $this->platforms()->avg('cost_per_mille');
        return $cost_per_mille;
    }
}
