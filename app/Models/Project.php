<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $product_name
 * @property string $product_nm
 * @property string $product_link
 * @property float $product_price
 * @property int $status
 * @property int $seller_id
 * @property string|null $marketplace_brand
 * @property string|null $marketplace_category
 * @property string|null $marketplace_product_name
 * @property string|null $marketplace_description
 * @property string|null $marketplace_options
 * @property int|null $marketplace_rate
 * @property int|null $is_blogger_access
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Seller|null $seller
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deal> $works
 * @property-read int|null $works_count
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereIsBloggerAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMarketplaceBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMarketplaceCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMarketplaceDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMarketplaceOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMarketplaceProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereMarketplaceRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereProductLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereProductNm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereProductPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereSellerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Project withoutTrashed()
 * @mixin \Eloquent
 */
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
