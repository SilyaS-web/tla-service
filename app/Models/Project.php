<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const FEEDBACK = 'feedback';

    public const TYPES = [
        self::FEEDBACK,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_type',
        'project_name',
        'product_name',
        'product_link',
        'product_price',
        'status',
        'seller_id'
    ];

    public function executor()
    {
    }

    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class, 'source_id', 'id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'project_id', 'id');
    }

    public function countActiveBloggers() {

    }

    public function getImageURL($only_primary = false)
    {
        if ($only_primary) {
            if ($this->projectFiles->first()) {
                return url('storage/' . $this->projectFiles->first()->link);
            }
        } else {
            $projectFiles = $this->projectFiles;
            $urls = [];

            foreach ($projectFiles as $projectFile) {
                $urls[] = url('storage/' . $projectFile->link);
            }

            if (!empty($urls)) {
                return $urls;
            }
        }

        return null;
    }
}
