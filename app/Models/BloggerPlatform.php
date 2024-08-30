<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BloggerPlatform extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blogger_id',
        'platform_id',
        'subscriber_quantity',
        'coverage',
        'additional_coverage',
        'link',
        'engagement_rate',
        'additional_engagement_rate',
        'cost_per_mille',
        'icon_url',
    ];

    public function platform()
    {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }

    public function blogger()
    {
        return $this->belongsTo(Blogger::class, 'id', 'blogger_id');
    }

    public static function getFields() {
        return [
            'Telegram' => [
                'coverage' => 'Просмотры',
            ],
            'VK' => [
                'coverage' => 'Просмотры постов',
                'additional_coverage' => 'Просмотры клипов',
            ],
            'Youtube' => [
                'coverage' => 'Просмотры выпуска',
                'additional_coverage' => 'Просмотры shorts',
            ],
            'Instagram' => [
                'coverage' => 'Просмотры reels',
            ],
        ];
    }
}
