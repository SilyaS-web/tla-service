<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloggerTheme extends Model
{
    use HasFactory;
    protected $fillable = [
        'blogger_id',
        'theme_id',
    ];

    public function theme()
    {
        return $this->hasOne(Theme::class, 'id', 'theme_id');
    }

    public function blogger()
    {
        return $this->hasOne(Blogger::class, 'id', 'blogger_id');
    }
}
