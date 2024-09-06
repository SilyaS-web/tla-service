<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'telegram_verified_at' => 'datetime',
    ];

    public function works()
    {
        if ($this->role == 'seller') {
            return $this->seller->works();
        } else {
            return $this->blogger->works();
        }
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'seller_id', 'id');
    }

    public function blogger()
    {
        return $this->hasOne(Blogger::class, 'user_id', 'id');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function tgPhone() {
        return $this->hasOne(TgPhone::class,'id', 'tg_phone_id');
    }

    public function getImageURL()
    {
        if (empty($this->image)) {
            return asset('img/profile-icon.svg');
        }

        return url('storage/' . $this->image);
    }

    public function getPassword() {
        return $this->password;
    }

    public function sellerTariffs()
    {
        return $this->hasMany(SellerTariff::class, 'user_id', 'id');
    }

    public function getActiveTariffs($type = null) {
        $tariffs = $this->sellerTariffs()->where('finish_date', '>', Carbon::now());
        if ($type) {
            $tariffs->where('type', $type);
            return $tariffs->first();
        }
        return $tariffs->get();
    }

    public function getActiveTariffByGroup($group_id) {
        $tariff = $this->sellerTariffs()->where('finish_date', '>', Carbon::now())->whereHas('tariff', function (Builder $query) use ($group_id) {
            $query->where('group_id', $group_id);
        })->first();

        if ($tariff) {
            return $tariff;
        }

        return null;
    }

    public function getActiveTariffsWithLost() {
        $seller_tariffs = $this->tariffs()->where('finish_date', '>', Carbon::now())->get();
        foreach ($seller_tariffs as &$seller_tariff) {
            $seller_tariff->lost = $seller_tariff->quantity - $this->seller->works()->whereHas('projectWork', function (Builder $query) use ($seller_tariff) {
                $query->where('type', $seller_tariff->type);
            })->count();
        }
        return $seller_tariffs;
    }
}
