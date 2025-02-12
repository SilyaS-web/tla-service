<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DeepLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'link',
        'destination',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work(): HasOne
    {
        return $this->hasOne(Deal::class, 'id', 'work_id');
    }
}
