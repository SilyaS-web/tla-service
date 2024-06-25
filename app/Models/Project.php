<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const FEEDBACK = 'feedback';
    public const INSTAGRAM = 'inst';

    public const TYPE_NAMES = [
        self::FEEDBACK => 'Отзыв на товар',
        self::INSTAGRAM => 'Рекламная интеграция (inst)'
    ];

    public const TYPES = [
        self::FEEDBACK,
        self::INSTAGRAM
    ];

    public const BANNED = -2;
    public const ACTIVE = 0;
    public const COMPLETED = 1;

    public const STATUSES = [
        self::BANNED,
        self::ACTIVE,
        self::COMPLETED
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
        'wb_category',
        'wb_product_name',
        'wb_description',
        'wb_options',
        'wb_rate',
        'is_blogger_access'
    ];

    public function executor()
    {
    }

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

    public function getCoverage()
    {
        return 0;
    }

    public function getClicksCount()
    {
        $works = Work::where([['project_id', $this->id]])->get();
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
                    'name' => self::TYPE_NAMES[$project_work->type],
                    'total_quantity' => $project_work->quantity,
                    'lost_quantity' => $project_work->quantity - $this->works()->where('project_work_id', $project_work->id)->count()
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

    public function getStatistics()
    {
        $ch = curl_init();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://anabar.ai/api/chrome/v1/product/wb/' . $this->product_nm);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: */*',
            'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
            'origin: https://www.wildberries.ru',
            'priority: u=1, i',
            'referer: https://www.wildberries.ru/catalog/' . $this->product_nm . '/detail.aspx',
            'sec-ch-ua: "Google Chrome";v="125", "Chromium";v="125", "Not.A/Brand";v="24"',
            'sec-ch-ua-mobile: ?0',
            'sec-ch-ua-platform: "Windows"',
            'sec-fetch-dest: empty',
            'sec-fetch-mode: cors',
            'sec-fetch-site: cross-site',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',
        ]);
        curl_setopt($ch, CURLOPT_COOKIE, '_ym_uid=1715183653727565142; _ym_d=1715183653; _ymab_param=tf7wZFLDwVBcQyli3tGkT4AH8FV2XqRvd2LdmTJirQRRWS6OZndTxIFRkfZ_r3R5HsOmGU7rBvwOwgkFCthtJhUzDH4; _ct_server=2600000000047472551; remember_token=218237|e9e573a6b3907b2dd8aa8b08371f48a4dc16dc59de313f9f365b4b09a7888182907281f316cf23bc91d57c86ad31fbeef41e0720133e3067bb588a11469e28c4; _hjSessionUser_3289482=eyJpZCI6IjFiMGY0ODQ3LTM0MGItNTY3ZC04ZTFlLWQyZTFhMjI1MmMwNiIsImNyZWF0ZWQiOjE3MTUxODQyMzQ4NjMsImV4aXN0aW5nIjp0cnVlfQ==; session=.eJwljktqxEAMRO_S6xjUUv_kyxi5JZGBxAnu8WrI3dNmdkVBvXqvsPlp4zOsLl_DPsL20LCGwtq6dqyAykC1ZmmdXHonRk7NCyqqKwBESliwRZibqN0ZISkJg1Kx3XPxvURLwLlmU2NpWDmbe2SwXLmCUNZIM5YGzVWIUrhFxrhMN3mGNdaYc2uTPPtfO7_lsGP2z_O6lYeN8fg53uoG6sSyLwK8Lwk1Lq0WWKjrPn-z1O43_hp2vhcYG1INf_8ABkxz.ZlUq6A.0B3D4AtxjQPBx2hgXN5OR2F-HBA');

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $httpcode == 200 ? $response : false;
    }

    public function getCountStatistics()
    {
        $ch = curl_init();

        $ch = curl_init();
        $url = 'https://card.wb.ru/cards/detail?nm=' . $this->product_nm . '&appType=1&locale=ru&lang=ru&curr=rub&dest=1';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $response = json_decode($response);

        return $httpcode == 200 && !empty($response->data->products) ? $response->data->products[0] : false;
    }
}
