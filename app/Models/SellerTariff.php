<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerTariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'tariff_id',
        'quantity',
        'type',
        'finish_date',
        'activation_date',
        'user_id',
    ];

    public function tariff()
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
