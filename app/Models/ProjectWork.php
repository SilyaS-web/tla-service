<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string $quantity
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $finish_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project|null $project
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $works
 * @property-read int|null $works_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereFinishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectWork whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProjectWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'quantity',
        'project_id',
        'finish_date'
    ];

    protected $casts = [
        'finish_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Deal::class, 'project_work_id', 'id');
    }
}
