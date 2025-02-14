<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $tariff_id
 * @property int|null $quantity
 * @property string $type
 * @property \Illuminate\Support\Carbon $finish_date
 * @property \Illuminate\Support\Carbon $activation_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $User
 * @property-read \App\Models\Tariff|null $tariff
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff query()
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereActivationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereFinishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereTariffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SellerTariff withoutTrashed()
 * @mixin \Eloquent
 */
class SellerTariff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tariff_id',
        'quantity',
        'type',
        'finish_date',
        'activation_date',
        'user_id',
    ];

    protected $casts = [
        'finish_date' => 'datetime',
        'activation_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function tariff(): HasOne
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }

    public function User(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
