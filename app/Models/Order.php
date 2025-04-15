<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 *
 * @property int $id
 * @property string $specification
 * @property int $price
 * @property-read Work|null $work
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Order withoutTrashed()
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'specification',
        'price',
        'complete_till',
        'completed_at',
        'work_id',
        'status',
    ];

    const REJECTED = -1;
    const PENDING = 0;
    const ACCEPTED = 1;
    const COMPLETED = 2;

    public function work(): HasOne
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }
}
