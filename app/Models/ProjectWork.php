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
        'finish_date'
    ];

    protected $casts = [
        'finish_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project() {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function getProjectWorkName()
    {
        $name = '';

        if (isset(Project::TYPE_NAMES[$this->type])) {
            $name = Project::TYPE_NAMES[$this->type];
        }

        return $name;
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'project_work_id', 'id');
    }
}
