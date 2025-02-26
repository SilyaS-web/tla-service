<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProjectWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'project_work_id',
    ];
}
