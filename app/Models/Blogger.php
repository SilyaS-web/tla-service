<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $description
 * @property int|null $is_achievement
 * @property string|null $name
 * @property int|null $country_id
 * @property string|null $city
 * @property float|null $gender_ratio
 * @property string|null $sex
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $content_published_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BloggerContent> $content
 * @property-read int|null $content_count
 * @property-read \App\Models\Country|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $deals
 * @property-read int|null $deals_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BloggerPlatform> $platforms
 * @property-read int|null $platforms_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BloggerTheme> $themes
 * @property-read int|null $themes_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereContentPublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereGenderRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereIsAchievement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Blogger withoutTrashed()
 * @mixin \Eloquent
 */
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

    public function deals(): HasMany
    {
        return $this->hasMany(Deal::class, 'blogger_id', 'id');
    }

    public function themes(): HasMany
    {
        return $this->hasMany(BloggerTheme::class, 'blogger_id', 'id');
    }
}
