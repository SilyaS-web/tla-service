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
}
