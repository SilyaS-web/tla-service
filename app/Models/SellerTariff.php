<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property int $id
 * @property int $tariff_id
 * @property int $quantity
 * @property string $type
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $finish_date
 * @property \Illuminate\Support\Carbon|null $activation_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
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

    public function canExtend(): bool
    {
        if ($this->quantity == 0 || $this->finish_date < Carbon::now()->addDays(7)) {
            return true;
        }

        return false;
    }
}
