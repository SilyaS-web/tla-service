<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TgPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'chat_id',
        'username',
    ];

    public function user(): hasOne
    {
        return $this->hasOne(User::class, 'tg_phone_id', 'id');
    }
}
