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
        'work_id',
        'message_id',
    ];

    public function work(): HasOne
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }
}
