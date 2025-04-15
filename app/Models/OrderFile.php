<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderFile extends Model
{
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
