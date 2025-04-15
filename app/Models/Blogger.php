<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'country_id',
        'balance',
        'id_status',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function platforms()
    {
        return $this->hasMany(BloggerPlatform::class, 'blogger_id', 'id');
    }

    public function content()
    {
        return $this->hasMany(BloggerContent::class, 'user_id', 'user_id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'blogger_id', 'user_id');
    }

    public function themes()
    {
        return $this->hasMany(BloggerTheme::class, 'blogger_id', 'id');
    }

    public function getSubscribers()
    {
        $quantity = round($this->platforms()->max('subscriber_quantity'), 2);
        return $quantity;
    }

    public function getCoverage()
    {
        $platform = $this->platforms()->orderBy('subscriber_quantity', 'desc')->first();
        $coverage = round($platform->coverage ?? 0, 2);
        return $coverage;
    }

    public function getER()
    {
        $platform = $this->platforms()->orderBy('subscriber_quantity', 'desc')->first();
        $engagement_rate = round($platform->engagement_rate ?? 0, 2);
        return $engagement_rate;
    }

    public function getCPM()
    {
        $platform = $this->platforms()->orderBy('subscriber_quantity', 'desc')->first();
        $cost_per_mille = round($platform->cost_per_mille ?? 0, 2);
        return $cost_per_mille;
    }
}
