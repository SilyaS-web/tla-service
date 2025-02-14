<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereSourceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MessageFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MessageFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'type',
        'link',
    ];
}
