<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TgPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'chat_id',
        'username',
    ];
}
