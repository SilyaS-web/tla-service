<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerContent whereUserId($value)
 * @mixin \Eloquent
 */
class BloggerContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'path',
    ];
}
