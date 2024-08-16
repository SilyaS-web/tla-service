<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    public function work()
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }
}
