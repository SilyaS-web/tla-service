<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'quantity',
        'project_id',
    ];

    public function project() {
        return $this->belongsTo(ProjectWork::class, 'id', 'project_id');
    }
}
