<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $image
 * @property string|null $code
 * @property string|null $code_description
 * @property string|null $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner query()
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCodeDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Partner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'code',
        'code_description',
        'link',
        'image'
    ];
}
