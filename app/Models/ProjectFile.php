<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $source_id
 * @property int $type
 * @property string $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|ProjectFile withoutTrashed()
 * @mixin \Eloquent
 */
class ProjectFile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'source_id',
        'type',
        'link',
    ];
}
