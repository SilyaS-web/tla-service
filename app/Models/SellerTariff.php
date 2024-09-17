<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    protected $dates = [
        'finish_date',
        'activation_date',
        'created_at',
        'updated_at',
    ];

    public function tariff()
    {
        return $this->hasOne(Tariff::class, 'id', 'tariff_id');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function canExtend() {
        if ($this->quantity == 0 || $this->finish_date < Carbon::now()->addDays(7)) {
            return true;
        }

        return false;
    }
}
