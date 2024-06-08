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

    public function getProjectWorkName()
    {
        $name = '';

        if (isset(Project::TYPE_NAMES[$this->type])) {
            $name = Project::TYPE_NAMES[$this->type];
        }

        return $name;
    }
}
