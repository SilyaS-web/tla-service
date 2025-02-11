<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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

    public function blogger(): HasOne
    {
        return $this->hasOne(Blogger::class, 'user_id', 'blogger_id');
    }

    public function seller(): HasOne
    {
        return $this->hasOne(Seller::class, 'user_id', 'seller_id');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'work_id', 'id');
    }

    public function getPartnerUser($role)
    {
        if ($role == 'seller') {
            return $this->blogger->user;
        } else {
            return $this->seller->user;
        }
    }

    public function accept($user): void
    {
        $param = 'accepted_by_' . $user->role . '_at';
        $this->$param = date('Y-m-d H:i');
        $this->save();
    }

    public function confirm($user): void
    {
        $param = 'confirmed_by_' . $user->role . '_at';
        $this->$param = date('Y-m-d H:i');
        $this->save();
    }

    public function isBothAccepted(): bool
    {
        return !empty($this->accepted_by_seller_at) && !empty($this->accepted_by_blogger_at);
    }

    public function getStatus(): string
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
