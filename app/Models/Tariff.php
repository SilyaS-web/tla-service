<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Tariff extends Model
{
    use HasFactory;

    const MINIMAL_QUANTITY = [
        Project::FEEDBACK => 10,
        Project::INTEGRATION => 10,
    ];

    // Массив для расчета стоимости по тарифу
    // Количество штук => Цена за штуку у тарифа с отзывами
    const PRICE_CONDITIONS = [
        Project::FEEDBACK => [
            10 => 100,
            20 => 90,
            30 => 80,
        ],
        Project::INTEGRATION => [
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
