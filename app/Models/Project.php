<?php

namespace App\Models;

use App\Services\OzonService;
use App\Services\WbService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const FEEDBACK = 'feedback';
    public const INSTAGRAM = 'inst';
    public const YOUTUBE = 'youtube';
    public const VK = 'vk';
    public const TELEGRAM = 'telegram';
    public const INTEGRATIONS = 'integrations';

    public const TYPE_NAMES = [
        self::FEEDBACK => 'Отзыв',
        self::INSTAGRAM => 'Интеграция Inst',
        self::YOUTUBE => 'Интеграция YouTube',
        self::VK => 'Интеграция VK',
        self::TELEGRAM => 'Интеграция Telegram',
        self::INTEGRATIONS => 'Все интеграции',
    ];

    public const TYPES = [
        self::FEEDBACK,
        self::INSTAGRAM,
        self::YOUTUBE,
        self::VK,
        self::TELEGRAM,
    ];

    public const INTEGRATION_TYPES = [
        self::INSTAGRAM,
        self::YOUTUBE ,
        self::VK,
        self::TELEGRAM,
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

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class, 'source_id', 'id');
    }
    public function projectWorks()
    {
        return $this->hasMany(ProjectWork::class, 'project_id', 'id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'project_id', 'id');
    }

    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id', 'seller_id');
    }

    public function getClicksCount()
    {
        $works = $this->works;
        $clicks_count = DeepLinkStat::whereHas('deepLink', function (Builder $query) use ($works) {
            $query->whereIn('work_id', $works->pluck('id'));
        })->count();
        return $clicks_count;
    }

    public function getSuscribers()
    {
        $project_id = $this->id;
        $bloggers = Blogger::whereHas('works', function (Builder $query) use ($project_id) {
            $query->where('project_id', $project_id);
        })->get();

        $subscribers = 0;
        foreach ($bloggers as $blogger) {
            $subscribers += BloggerPlatform::where('blogger_id', $blogger->id)->avg('subscriber_quantity');
        }

        return $subscribers;
    }

    public function getFinishStats()
    {
        $project_id = $this->id;
        $finishStats = FinishStats::selectRaw('sum(subs) as total_subs, sum(views) as total_views, sum(reposts) as total_reposts, sum(likes) as total_likes')->whereHas('work', function (Builder $query) use ($project_id) {
            $query->where('project_id', $project_id);
        })->first();

        return $finishStats;
    }

    public function getStatusName()
    {
        if (!$this->is_blogger_access) {
            return "Не опубликовано";
        }

        switch ($this->status) {
            case self::BANNED:
                return "Заблокирован";

            case self::ACTIVE:
                return "Активно";

            case self::COMPLETED:
                return "Завершено";

            case self::STOPPED:
                return "Приостановлен";
        }

        $is_null = true;
        foreach ($this->projectWorks as $project_work) {
            $lost = $project_work->quantity - Work::where('project_work_id', $project_work->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
            if ($lost > 0) {
                $is_null = false;
            }
        }
        if ($is_null) {
            $this->update(['status' => self::COMPLETED]);
            return "Завершено";
        }

        return "Активно";
    }

    public function isSended($user = null)
    {
        if (!$user) {
            $user = Auth::user();
        }

        $work = Work::where('blogger_id', $user->id)->where('project_id', $this->id)->first();
        if ($work) {
            return true;
        }

        return false;
    }

    public function isCompleted()
    {
        $is_null = true;
        if ($this->status == self::COMPLETED) {
            return true;
        }

        foreach ($this->projectWorks as $project_work) {
            $lost = $project_work->quantity - Work::where('project_work_id', $project_work->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count();
            if ($lost > 0) {
                $is_null = false;
            }
        }

        if ($is_null) {
            $this->update(['status' => self::COMPLETED]);
        }

        return $is_null;
    }

    public function getStatusClass()
    {
        if (!$this->is_blogger_access || $this->status == self::BANNED) {
            return "disactive";
        }

        return "active";
    }

    public function getProjectWorkNames($format = null)
    {
        $project_works = $this->projectWorks;
        $names = [];
        if ($format) {
            if (self::TYPE_NAMES[$format]) {
                return self::TYPE_NAMES[$format];
            }

            return null;
        }

        foreach ($project_works as $project_work) {
            if (isset(self::TYPE_NAMES[$project_work->type])) {
                $names[] = self::TYPE_NAMES[$project_work->type];
            }
        }

        return $names;
    }

    public function getProjectWorkNamesWithQuantity()
    {
        $project_works = $this->projectWorks;
        $formats = [];

        foreach ($project_works as $project_work) {
            if (isset(self::TYPE_NAMES[$project_work->type])) {
                $formats[] = [
                    'id' => $project_work->id,
                    'name' => self::TYPE_NAMES[$project_work->type],
                    'total_quantity' => $project_work->quantity,
                    'lost_quantity' => $project_work->quantity - $this->works()->where('project_work_id', $project_work->id)->whereIn('status', [Work::IN_PROGRESS, Work::COMPLETED])->count(),
                ];
            }
        }

        return $formats;
    }

    public function getImageURL($only_primary = false)
    {
        if ($only_primary) {
            if ($this->projectFiles->first()) {
                return url('storage/' . $this->projectFiles->first()->link);
            }
        } else {
            $projectFiles = $this->projectFiles;
            $urls = [];

            foreach ($projectFiles as $projectFile) {
                $urls[] = url('storage/' . $projectFile->link);
            }

            if (!empty($urls)) {
                return $urls;
            }
        }

        return null;
    }


    public function getStatistics(string $ozon_client_id = null, string $ozon_api_key = null)
    {
        $start_date = now()->subDays(30);
        $end_date = now();
        $bloggers_finish = Work::selectRaw('DATE_FORMAT(confirmed_by_seller_at, "%Y-%m-%d") as date')->where('project_id', $this->id)->where('status', Work::COMPLETED)->whereBetween('created_at', [$start_date, $end_date])->get();
        $bloggers_history = [];
        foreach ($bloggers_finish as $blogger_finish) {
            if (isset($bloggers_history[$blogger_finish->date])) {
                $bloggers_history[$blogger_finish->date]['bloggers'] += 1;
            } else {
                $bloggers_history[$blogger_finish->date] = [
                    'dt' => $blogger_finish->date,
                    'bloggers' => 1
                ];
            }
        }

        if (strripos($this->product_link, 'ozon') !== false && $ozon_client_id && $ozon_api_key) {
            $stats = array_merge(OzonService::getOrdersStats($this->product_nm, intval($ozon_client_id), $ozon_api_key) ?? [], ['bloggers_history' => array_values($bloggers_history)]);
        } else {
            $stats = array_merge(WbService::getOrdersStats($this->product_nm) ?? [], ['bloggers_history' => array_values($bloggers_history)]);
        }

        return json_encode($stats);
    }
}
