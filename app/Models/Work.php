<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'blogger_id',
        'seller_id',
        'project_id',
        'confirmed_by_blogger_at',
        'confirmed_by_seller_at',
        'status',
    ];

    public function blogger()
    {
        return $this->hasOne(Blogger::class, 'user_id', 'blogger_id');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id', 'seller_id');
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function messages() {
        return $this->hasMany(Message::class,'work_id','id');
    }
}
