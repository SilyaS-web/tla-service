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

    protected $dates = [
        'viewed_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work()
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }

    public function messageFiles()
    {
        return $this->hasMany(MessageFile::class, 'source_id', 'id');
    }

    public function finishStats()
    {
        return $this->hasOne(FinishStats::class, 'message_id', 'id');
    }
}
