<?php

namespace App\Models;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property int $id
 * @property int $user_id
 * @property int $organization_name
 * @property string|null $organization_type
 * @property int|null $is_achievement
 * @property int $is_agent
 * @property string|null $inn
 * @property string|null $description
 * @property string|null $finish_date
 * @property string|null $wb_link
 * @property string|null $wb_api_key
 * @property string|null $ozon_link
 * @property string|null $ozon_api_key
 * @property string|null $ozon_client_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $deals
 * @property-read int|null $deals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @property-read \App\Models\User|null $user
 * @method static EloquentBuilder|Seller newModelQuery()
 * @method static EloquentBuilder|Seller newQuery()
 * @method static EloquentBuilder|Seller onlyTrashed()
 * @method static EloquentBuilder|Seller query()
 * @method static EloquentBuilder|Seller whereCreatedAt($value)
 * @method static EloquentBuilder|Seller whereDeletedAt($value)
 * @method static EloquentBuilder|Seller whereDescription($value)
 * @method static EloquentBuilder|Seller whereFinishDate($value)
 * @method static EloquentBuilder|Seller whereId($value)
 * @method static EloquentBuilder|Seller whereInn($value)
 * @method static EloquentBuilder|Seller whereIsAchievement($value)
 * @method static EloquentBuilder|Seller whereIsAgent($value)
 * @method static EloquentBuilder|Seller whereOrganizationName($value)
 * @method static EloquentBuilder|Seller whereOrganizationType($value)
 * @method static EloquentBuilder|Seller whereOzonApiKey($value)
 * @method static EloquentBuilder|Seller whereOzonClientId($value)
 * @method static EloquentBuilder|Seller whereOzonLink($value)
 * @method static EloquentBuilder|Seller whereUpdatedAt($value)
 * @method static EloquentBuilder|Seller whereUserId($value)
 * @method static EloquentBuilder|Seller whereWbApiKey($value)
 * @method static EloquentBuilder|Seller whereWbLink($value)
 * @method static EloquentBuilder|Seller withTrashed()
 * @method static EloquentBuilder|Seller withoutTrashed()
 * @mixin \Eloquent
 */

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

    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class, 'seller_id', 'id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'seller_id', 'id');
    }
}
