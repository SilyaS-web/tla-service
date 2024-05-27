<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'work_id',
        'message',
        'viewed_at',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work() {
        return $this->hasOne(Work::class,'id','work_id');
    }
}
