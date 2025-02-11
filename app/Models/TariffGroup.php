<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TariffGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function tariffs()
    {
        return $this->hasMany(Tariff::class, 'group_id', 'id');
    }
}
