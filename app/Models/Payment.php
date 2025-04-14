<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property int $payment_id
 * @property int $tariff_id
 * @property int $price
 * @property string $status
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory;

    const COMPLETED = 'completed';
    const CANCELED = 'canceled';
    const FAILED = 'failed';

    const TARIFF_TYPE = 'tariff';
    const TOP_UP_TYPE = 'top_up';

    protected $fillable = [
        'user_id',
        'payment_id',
        'price',
        'tariff_id',
        'tariff_id',
        'type',
        'status',
        'quantity',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tariff(): HasOne
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }
}
