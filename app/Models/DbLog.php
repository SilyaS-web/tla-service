<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DbLog whereUserId($value)
 * @mixin \Eloquent
 */
class DbLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'text',
    ];
}
