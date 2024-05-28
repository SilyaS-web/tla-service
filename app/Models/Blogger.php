<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    use HasFactory, SoftDeletes;

    public const YOUTUBE = 'youtube';
    public const INSTAGRAM = 'instagram';
    public const VK = 'vk';
    public const TELEGRAM = 'telegram';

    const PLATFORM_TYPES = [
        self::YOUTUBE,
        self::INSTAGRAM,
        self::VK,
        self::TELEGRAM,
    ];

    protected $fillable = [
        'user_id',
        'platform',
        'name',
        'description',
        'subscriber_quantity',
        'coverage',
        'engagement_rate',
        'cost_per_mille',
        'gender_ratio',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
