<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'text',
        'work_id',
        'from_user_id',
        'viewed_at'
    ];

    protected $casts = [
        'viewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work()
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }

    public function fromUser()
    {
        return $this->hasOne(User::class, 'id', 'from_user_id');
    }
}
