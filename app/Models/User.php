<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property TgPhone $tgPhone
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property string|null $image
 * @property string $role
 * @property string $password
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $telegram_verified_at
 * @property int $tg_phone_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int|null $is_admin
 * @property-read \App\Models\Blogger|null $blogger
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Project> $projects
 * @property-read int|null $projects_count
 * @property-read \App\Models\Seller|null $seller
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SellerTariff> $sellerTariffs
 * @property-read int|null $seller_tariffs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereImage($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereTelegramVerifiedAt($value)
 * @method static Builder|User whereTgPhoneId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User withTrashed()
 * @method static Builder|User withoutTrashed()
 * @mixin \Eloquent
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public const SELLER = 'seller';
    public const BLOGGER = 'blogger';
    public const ADMIN = 'admin';
    public const AGENT = 'agent';

    public const TYPES = [
        self::SELLER, self::BLOGGER, self::ADMIN, self::AGENT
    ];

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'image',
        'status',
        'role',
        'tg_phone_id',
        'password',
        'telegram_verified_at',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'telegram_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function works(): Collection|null
    {
        if ($this->role == self::SELLER && $this->seller) {
            return $this->seller->works() ?? null;
        } else if ($this->role == self::BLOGGER && $this->blogger) {
            return $this->blogger->works() ?? null;
        }

        return null;
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function projects(): HasManyThrough|HasMany
    {
        if ($this->role == 'seller') {
            return $this->hasMany(Project::class, 'seller_id', 'id');
        }

        return $this->hasManyThrough(
            Project::class,
            Deal::class,
            'blogger_id',
            'id',
            'id',
            'project_id'
        );
    }

    public function blogger(): HasOne
    {
        return $this->hasOne(Blogger::class, 'user_id', 'id');
    }

    public function seller(): HasOne
    {
        return $this->hasOne(Seller::class, 'user_id', 'id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function sellerTariffs(): HasMany
    {
        return $this->hasMany(SellerTariff::class, 'user_id', 'id');
    }

    public function getActiveTariffs($type = null)
    {
        $tariffs = $this->sellerTariffs()->where('finish_date', '>', Carbon::now());
        if ($type) {
            $tariff = null;
            if (in_array($type, Project::BARTER_TYPES)) {
                $tariff = $tariffs->where('type', Project::BARTER)->first();
            }

            if (!$tariff) {
                $tariff = $tariffs->where('type', $type)->first();
            }

            if (!$tariff && in_array($type, Project::INTEGRATION_TYPES)) {
                $tariff = $tariffs->where('type', Project::INTEGRATION)->first();
            }

            return $tariff;
        }

        return $tariffs->get();
    }
}
