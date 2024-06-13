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
        'country_id'
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
        $coverage = round($this->platforms()->avg('coverage'), 2);
        return $coverage;
    }

    public function getER()
    {
        $engagement_rate = round($this->platforms()->avg('engagement_rate'), 2);
        return $engagement_rate;
    }

    public function getCPM()
    {
        $cost_per_mille = round($this->platforms()->avg('cost_per_mille'), 2);
        return $cost_per_mille;
    }
}
