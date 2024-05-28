<?php

namespace App\Models;

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

    public const TYPES = [
        self::SELLER, self::BLOGGER, self::ADMIN
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
        'role',
        'password',
        'telegram_verified_at',
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

    public function projects()
    {
        return $this->hasMany(Project::class, $this->role . '_id', 'id');
    }

    public function blogger()
    {
        return $this->hasOne(Blogger::class, 'user_id', 'id');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id', 'id');
    }

    public function getImageURL()
    {
        if (empty($this->image)) {
            return null;
        }

        return url('storage/' . $this->image);
    }
}
