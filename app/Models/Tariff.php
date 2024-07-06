<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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

    public function tariffGroup()
    {
        return $this->hasOne(TariffGroup::class, 'id', 'group_id');
    }

    public function sellerTariffs()
    {
        return $this->hasMany(SellerTariff::class, 'tariff_id', 'id');
    }

    public function isActive() {
        $user_active = $this->sellerTariffs()->where('user_id', Auth::user()->id)->where('finish_date', '>', Carbon::now())->first();
        return $user_active ? true : false;
    }
}
