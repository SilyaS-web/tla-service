<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    const COMPLETED = 'completed';
    const CANCELED = 'canceled';
    const FAILED = 'failed';

    protected $fillable = [
        'user_id',
        'payment_id',
        'tariff_id',
        'price',
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
