<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserAchievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAchievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAchievement onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAchievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAchievement withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAchievement withoutTrashed()
 * @mixin \Eloquent
 */
class UserAchievement extends Model
{
    use HasFactory, SoftDeletes;
}
