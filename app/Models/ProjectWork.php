<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProjectWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'quantity',
        'project_id',
        'finish_date'
    ];

    protected $casts = [
        'finish_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function works(): HasMany
    {
        return $this->hasMany(Deal::class, 'project_work_id', 'id');
    }
}
