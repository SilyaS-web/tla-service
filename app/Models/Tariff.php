<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tariff extends Model
{
    use HasFactory;

    const MINIMAL_QUANTITY = [
        Project::FEEDBACK => 10,
        Project::INTEGRATIONS => 10,
    ];

    // Массив для расчета стоимости по тарифу
    // Количество штук => Цена за штуку у тарифа с отзывами
    const PRICE_CONDITIONS = [
        Project::FEEDBACK => [
            10 => 100,
            20 => 90,
            30 => 80,
        ],
        Project::INTEGRATIONS => [
            10 => 200,
            20 => 180,
            30 => 160,
        ],
    ];

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
