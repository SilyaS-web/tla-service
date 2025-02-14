<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralCode withoutTrashed()
 * @mixin \Eloquent
 */
class ReferralCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'code',
        'name',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
