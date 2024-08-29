<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ReferralUsers extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'referral_code_id',
        'user_id'
        'role'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function referralCode()
    {
        return $this->hasOne(ReferralCode::class, 'id', 'referral_code_id');
    }
}
