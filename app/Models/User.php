<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

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
