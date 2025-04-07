<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'specification',
        'price',
        'complete_till',
        'completed_at',
        'work_id',
        'status',
    ];
}
