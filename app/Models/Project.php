<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const FEEDBACK = 'feedback';
    public const INSTAGRAM = 'inst';
    public const YOUTUBE = 'youtube';
    public const VK = 'vk';
    public const TELEGRAM = 'telegram';
    public const OK = 'ok';
    public const DZEN = 'dzen';
    public const YAPPY = 'yappy';
    public const RUTUBE = 'rutube';
    public const TIKTOK = 'tiktok';
    public const INTEGRATION = 'integration';
    public const UGC_CONTENT = 'ugc_content';
    public const BARTER = 'barter';

    public const TYPE_NAMES = [
        self::FEEDBACK => 'Выкуп + Отзыв',
        self::INSTAGRAM => 'Интеграция Inst',
        self::YOUTUBE => 'Интеграция YouTube',
        self::VK => 'Интеграция VK',
        self::TELEGRAM => 'Интеграция Telegram',
        self::OK => 'Интеграция Одноклассники',
        self::DZEN => 'Интеграция Дзен',
        self::YAPPY => 'Интеграция Yappy',
        self::RUTUBE => 'Интеграция Rutube',
        self::TIKTOK => 'Интеграция Tiktok',
        self::INTEGRATION => 'Интеграции',
        self::UGC_CONTENT => 'UGC-контент',
        self::BARTER => 'Безлимит',
    ];

    public const TYPES = [
        self::INTEGRATION,
        self::FEEDBACK,
        self::UGC_CONTENT
    ];

    public const INTEGRATION_TYPES = [
        self::INSTAGRAM,
        self::YOUTUBE,
        self::VK,
        self::TELEGRAM,
        self::OK,
        self::DZEN,
        self::YAPPY,
        self::RUTUBE,
        self::TIKTOK,
    ];

    public const BARTER_TYPES = [
        self::INTEGRATION,
        self::FEEDBACK,
        self::UGC_CONTENT,
        self::INSTAGRAM,
        self::YOUTUBE,
        self::TELEGRAM,
        self::VK,
        self::OK,
        self::DZEN,
        self::YAPPY,
        self::RUTUBE,
        self::TIKTOK,
    ];

    public const STOPPED = -3;
    public const BANNED = -2;
    public const PENDING = -1;
    public const ACTIVE = 0;
    public const COMPLETED = 1;

    public const STATUSES = [
        self::STOPPED,
        self::BANNED,
        self::PENDING,
        self::ACTIVE,
        self::COMPLETED,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_name',
        'product_nm',
        'product_link',
        'product_price',
        'status',
        'seller_id',
        'marketplace_brand',
        'marketplace_category',
        'marketplace_product_name',
        'marketplace_description',
        'marketplace_options',
        'marketplace_rate',
        'is_blogger_access',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function works(): HasMany
    {
        return $this->hasMany(Deal::class, 'project_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(USer::class, 'id', 'user_id');
    }

    public function seller(): HasOne
    {
        return $this->hasOne(Seller::class, 'id', 'seller_id');
    }
}
