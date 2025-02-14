<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property int $price
 * @property string $type
 * @property int $quantity
 * @property int $period
 * @property int $group_id
 * @property int $is_active
 * @property int $is_best
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SellerTariff> $sellerTariffs
 * @property-read int|null $seller_tariffs_count
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereIsBest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tariff whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
