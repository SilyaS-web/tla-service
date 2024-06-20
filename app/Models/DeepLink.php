<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeepLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_id',
        'link',
        'destination',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function work()
    {
        return $this->hasOne(Work::class, 'id', 'work_id');
    }

    public function deepLinkStat()
    {
        return $this->hasMany(DeepLinkStat::class, 'link_id', 'id');
    }

    public function getClicksCount() {
        $deep_link_stat_count = $this->deepLinkStat()->count();

        return $deep_link_stat_count;
    }
}
