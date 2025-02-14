<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $chat_id
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string|null $username
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone query()
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TgPhone whereUsername($value)
 * @mixin \Eloquent
 */
class TgPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'chat_id',
        'username',
    ];
}
