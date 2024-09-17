<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tariff()
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }
}
