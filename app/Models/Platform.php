<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property string $title
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder|Platform newModelQuery()
 * @method static Builder|Platform newQuery()
 * @method static Builder|Platform query()
 * @method static Builder|Platform whereCreatedAt($value)
 * @method static Builder|Platform whereId($value)
 * @method static Builder|Platform whereImage($value)
 * @method static Builder|Platform whereTitle($value)
 * @method static Builder|Platform whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
    ];
}
