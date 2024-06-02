<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloggerPlatform extends Model
{
    use HasFactory;

    protected $fillable = [
        'blogger_id',
        'name',
        'subscriber_quantity',
        'coverage',
        'engagement_rate',
        'cost_per_mille',
    ];
}
