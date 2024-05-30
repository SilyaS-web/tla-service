<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeepLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'destination',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work() {
        return $this->hasOne(Work::class, 'id','work_id');
    }
}
