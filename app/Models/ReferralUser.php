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
 * @property int $referral_code_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser whereReferralCodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ReferralUser withoutTrashed()
 * @mixin \Eloquent
 */
class ReferralUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'referral_code_id',
        'user_id',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
