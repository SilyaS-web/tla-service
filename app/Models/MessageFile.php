<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'source_id',
        'type',
        'link',
    ];

    public function getURL()
    {
        return url('storage/' . $this->link);
    }
}
