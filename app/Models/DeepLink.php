<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $work_id
 * @property string $destination
 * @property string $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\Deal|null $work
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereDestination($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLink whereWorkId($value)
 * @mixin \Eloquent
 */
class DeepLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'link',
        'destination',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work(): HasOne
    {
        return $this->hasOne(Deal::class, 'id', 'work_id');
    }
}
