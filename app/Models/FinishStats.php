<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int $subs
 * @property int $views
 * @property int $reposts
 * @property int $likes
 * @property int $work_id
 * @property int $message_id
 * @property string|null $platform
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Deal|null $deal
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereReposts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereSubs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinishStats whereWorkId($value)
 * @mixin \Eloquent
 */
class FinishStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'subs',
        'views',
        'reposts',
        'likes',
        'stats',
        'deal_id',
        'message_id',
    ];

    public function deal(): HasOne
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }
}
