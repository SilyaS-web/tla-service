<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int $blogger_id
 * @property int $theme_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blogger|null $blogger
 * @property-read \App\Models\Theme|null $theme
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme whereBloggerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme whereThemeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloggerTheme whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BloggerTheme extends Model
{
    use HasFactory;
    protected $fillable = [
        'blogger_id',
        'theme_id',
    ];

    public function theme(): HasOne
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id');
    }

    public function blogger(): HasOne
    {
        return $this->hasOne(Blogger::class, 'id', 'blogger_id');
    }
}
