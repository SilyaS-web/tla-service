<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    public const CANCELED = 'canceled';
    public const PENDING = 'pending';
    public const IN_PROGRESS = 'progress';
    public const COMPLETED = 'completed';

    public const STATUSES = [
        self::CANCELED,
        self::PENDING,
        self::IN_PROGRESS,
        self::COMPLETED,
    ];

    protected $fillable = [
        'blogger_id',
        'seller_id',
        'project_id',
        'message',
        'accepted_by_blogger_at',
        'accepted_by_seller_at',
        'confirmed_by_blogger_at',
        'confirmed_by_seller_at',
        'canceled_by_blogger_at',
        'canceled_by_seller_at',
        'status',
        'created_by',
        'project_work_id',
        'last_message_at'
    ];

    protected $casts = [
        'accepted_by_blogger_at' => 'datetime',
        'accepted_by_seller_at' => 'datetime',
        'confirmed_by_blogger_at' => 'datetime',
        'confirmed_by_seller_at' => 'datetime',
        'last_message_at' => 'datetime',
        'canceled_by_blogger_at' => 'datetime',
        'canceled_by_seller_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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

    public function messages()
    {
        return $this->hasMany(Message::class, 'work_id', 'id');
    }

    public function projectWork()
    {
        return $this->hasOne(ProjectWork::class, 'id', 'project_work_id');
    }

    public function finishStats()
    {
        return $this->hasOne(FinishStats::class, 'work_id', 'id');
    }

    public function deepLink()
    {
        return $this->hasOne(DeepLink::class, 'work_id', 'id');
    }

    public function getPartnerUser($role)
    {
        if ($role == 'seller') {
            return $this->blogger->user;
        } else {
            return $this->seller->user;
        }
    }

    public function accept($user)
    {
        $param = 'accepted_by_' . $user->role . '_at';
        $this->$param = date('Y-m-d H:i');
        $this->save();
    }

    public function confirm($user)
    {
        $param = 'confirmed_by_' . $user->role . '_at';
        $this->$param = date('Y-m-d H:i');
        $this->save();
    }

    public function isBothAccepted()
    {
        return !empty($this->accepted_by_seller_at) && !empty($this->accepted_by_blogger_at);
    }

    public function isAcceptedByUser($user)
    {
        $param = 'accepted_by_' . $user->role . '_at';
        if ($this->$param) {
            return true;
        }

        return false;
    }

    public function isConfirmedByUser($user)
    {
        $param = 'confirmed_by_' . $user->role . '_at';
        if ($this->$param) {
            return true;
        }

        return false;
    }

    public function getTotlaClicks()
    {
        $total_clicks = 0;

        $deepLink = $this->deepLink;
        if ($deepLink) {
            $total_clicks = $deepLink->getClicksCount();
        }

        return $total_clicks;
    }

    public function getStatus()
    {
        switch ($this->status) {
            case self::COMPLETED:
                return "Завершен";

            case self::IN_PROGRESS:
                return "Выполняется";

            case self::PENDING:
                return "Ожидает принятия";

            default:
                return "Заявка отправлена";
        }
    }
}
