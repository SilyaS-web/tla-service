<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $blogger_id
 * @property string $link
 * @property int|null $subscriber_quantity
 * @property int|null $coverage
 * @property float|null $engagement_rate
 * @property float|null $cost_per_mille
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $additional_coverage
 * @property float|null $additional_engagement_rate
 * @property int|null $platform_id
 * @property-read \App\Models\Blogger|null $blogger
 * @property-read \App\Models\Platform|null $platform
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereAdditionalCoverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereAdditionalEngagementRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereBloggerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereCostPerMille($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereCoverage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereEngagementRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform wherePlatformId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereSubscriberQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerPlatform withoutTrashed()
 * @mixin \Eloquent
 */
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

    public function platform(): HasOne
    {
        return $this->hasOne(Platform::class, 'id', 'platform_id');
    }

    public function blogger(): BelongsTo
    {
        return $this->belongsTo(Blogger::class, 'id', 'blogger_id');
    }

    public static function getFields(): array
    {
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
            'Dzen' => [
                'coverage' => 'Просмотры Дзен',
            ],
            'OK' => [
                'coverage' => 'Просмотры Одноклассники',
            ],
            'Rutube' => [
                'coverage' => 'Просмотры Rutube',
            ],
            'Yappy' => [
                'coverage' => 'Просмотры Yappy',
            ],
        ];
    }
}
