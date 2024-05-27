<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    public const TRIAL = 'trial';
    public const START = 'start';

    const TARIFFS = [
        self::TRIAL => [
            'quantity' => 1,
            'name' => 'Пробный'
        ],
        self::START => [
            'quantity' => 500,
            'name' => 'Начальный'
        ],
    ];

    protected $fillable = [
        'user_id',
        'platform',
        'platform_link',
        'organization_type',
        'is_agent',
        'description',
        'remaining_tariff',
        'tariff',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
