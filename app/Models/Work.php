<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    public const PENDING = 'pending';
    public const IN_PROGRESS = 'progress';
    public const COMPLETED = 'completed';

    public const STATUSES = [
        self::PENDING,
        self::IN_PROGRESS,
        self::COMPLETED,
    ];

    protected $fillable = [
        'blogger_id',
        'seller_id',
        'project_id',
        'accepted_by_blogger_at',
        'accepted_by_seller_at',
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

    public function getPartnerUser($role) {
        if ($role == 'seller') {
            return $this->blogger->user;
        } else {
            return $this->seller->user;
        }
    }

    public function accept($user) {
        $param = 'accepted_by_' . $user->role . '_at';
        $this->$param = self::IN_PROGRESS;
        $this->save();
    }

    public function confirm($user) {
        $param = 'confirmed_by_' . $user->role . '_at';
        $this->$param = self::IN_PROGRESS;
        $this->save();
    }

    public function isBothAcceptd() {
        return !empty($this->accepted_by_seller_at) && !empty($this->accepted_by_blogger_at);
    }
}
