<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FinishStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'subs',
        'views',
        'reposts',
        'likes',
        'stats',
        'deal_id',
        'message_id',
    ];

    public function deal(): HasOne
    {
        return $this->hasOne(Deal::class, 'id', 'deal_id');
    }
}
