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
        'is_achievement',
        'is_agent',
        'description',
        'finish_date',
        'remaining_tariff',
        'tariff',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function projects()
    // {
    //     return $this->hasManyThrough(
    //         Deployment::class,
    //         Environment::class,
    //         'project_id', // Foreign key on the environments table...
    //         'environment_id', // Foreign key on the deployments table...
    //         'id', // Local key on the projects table...
    //         'id' // Local key on the environments table...
    //     );
    // }
}
