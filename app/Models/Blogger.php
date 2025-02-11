<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blogger extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'sex',
        'is_achievement',
        'gender_ratio',
        'city',
        'country_id'
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function country(): HasOne
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function platforms(): HasMany
    {
        return $this->hasMany(BloggerPlatform::class, 'blogger_id', 'id');
    }

    public function content(): HasMany
    {
        return $this->hasMany(BloggerContent::class, 'user_id', 'user_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Work::class, 'blogger_id', 'user_id');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(BloggerTheme::class, 'blogger_id', 'id');
    }
}
