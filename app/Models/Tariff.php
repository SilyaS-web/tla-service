<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

/**
 *
 * @property int $id
 * @property int $price
 * @property string $title
 * @property string $description
 * @property string $type
 * @property int $quantity
 * @property int $period
 * @property int $group_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'quantity',
        'period',
        'group_id',
        'is_active',
        'is_best'
    ];

    public function tariffGroup(): HasOne
    {
        return $this->hasOne(TariffGroup::class, 'id', 'group_id');
    }

    public function sellerTariffs(): HasMany
    {
        return $this->hasMany(SellerTariff::class, 'tariff_id', 'id');
    }

    public function isActive(): bool
    {
        $user_active = $this->sellerTariffs()->where('user_id', Auth::user()->id)->where('finish_date', '>', Carbon::now())->first();
        return (bool)$user_active;
    }
}
