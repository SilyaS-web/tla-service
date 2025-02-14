<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tariff> $tariffs
 * @property-read int|null $tariffs_count
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TariffGroup whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TariffGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function tariffs(): HasMany
    {
        return $this->hasMany(Tariff::class, 'group_id', 'id');
    }
}
