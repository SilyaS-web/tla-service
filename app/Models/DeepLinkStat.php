<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DeepLinkStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'datetime',
        'device',
        'operating_system',
        'country',
        'federal_district',
        'region',
        'city',
        'referrer',
        'is_bot',
        'is_mobile',
    ];
}
