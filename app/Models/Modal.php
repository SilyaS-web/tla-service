<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Modal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Modal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Modal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Modal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Modal extends Model
{
    use HasFactory;
}
