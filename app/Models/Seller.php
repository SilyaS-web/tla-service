<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    public const TRIAL = 'trial';
    public const START = 'start';

    protected $fillable = [
        'user_id',
        'organization_name',
        'organization_type',
        'is_achievement',
        'is_agent',
        'description',
        'inn',
        'finish_date',
        'wb_link',
        'wb_api_key',
        'ozon_link',
        'ozon_api_key',
        'ozon_client_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'seller_id', 'user_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'seller_id', 'user_id');
    }
}
