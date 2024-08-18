<?php

namespace App\Models;

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

    public const TYPE_NAMES = [
        self::FEEDBACK => 'Отзыв',
        self::INSTAGRAM => 'Интеграция Inst',
        self::YOUTUBE => 'Интеграция YouTube',
        self::VK => 'Интеграция VK',
        self::TELEGRAM => 'Интеграция Telegram',
    ];

    public const TYPES = [
        self::FEEDBACK,
        self::INSTAGRAM,
        self::YOUTUBE,
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
        'is_blogger_access'
    ];

    public function executor() {}

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

    public function getActiveWorks()
    {
        $project = $this;
        $works = $this->works()->where(function (Builder $query) use ($project) {
            return $query->where('created_by', $project->seller_id)
                ->orWhere('status', '<>', null);
        })->get();

        return $works;
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

    public function isSended() {
        $user = Auth::user();
        $work = Work::where('blogger_id', $user->id)->first();
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
        $product = ($httpcode == 200 && !empty($response->data->products)) ? $response->data->products[0] : false;

        return $product;
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
            $stats = array_merge($this->getOzonStats(intval($ozon_client_id), $ozon_api_key) ?? [], ['bloggers_history' => array_values($bloggers_history)]);
        } else {
            $stats = array_merge($this->getWBStats() ?? [], ['bloggers_history' => array_values($bloggers_history)]);
        }

        return json_encode($stats);
    }


    public function getWBStats()
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
        $result = [];
        if ($httpcode != 200) {
            $result = [
                'orders' => 0,
                'earnings' => 0,
                'prices_history' => [],
                'orders_history' => [],
            ];
        }

        $result = $response;
        return json_decode($result, true);
    }

    public function getOzonStats(int $ozon_client_id, string $ozon_api_key)
    {
        $card = $this->getOzonGeneralInfo($ozon_client_id, $ozon_api_key);
        if (!$card) {
            $result = [
                'orders' => 0,
                'earnings' => 0,
                'prices_history' => [],
                'orders_history' => [],
            ];

            return $result;
        }

        $date_from = date('Y-m-d', strtotime("-1 month"));
        $date_to = date('Y-m-d');
        $filters = [];

        foreach ($card->sources as $source) {
            $filters[] = [
                "key" => "sku",
                "value" => "$source->sku"
            ];
        }

        $curl = curl_init();
        $post_data = [
            "date_from" => $date_from,
            "date_to" => $date_to,
            "metrics" => [
                "revenue",
                "ordered_units"
            ],
            "filters" => $filters,
            "dimension" => [
                "sku",
                "day"
            ],
            "sort" => [
                [
                    "key" => "day",
                    "order" => "ASC"
                ]
            ],
            "limit" => 1000,
            "offset" => 0
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v1/analytics/data',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Client-Id: ' . $ozon_client_id,
                'Api-Key: ' . $ozon_api_key,
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response);
        if (!isset($result->result)) {
            $result = [
                'orders' => 0,
                'earnings' => 0,
                'prices_history' => [],
                'orders_history' => [],
            ];

            return $result;
        }

        $result = $result->result;
        $date_array = [];
        foreach ($result->data as $data) {
            if (isset($date_array[$data->dimensions[1]->id])) {
                $date_array[$data->dimensions[1]->id] = [
                    'dt' => $data->dimensions[1]->id,
                    "earnings" => $data->metrics[0] + $date_array[$data->dimensions[1]->id]['earnings'],
                    "orders" => $data->metrics[1] + $date_array[$data->dimensions[1]->id]['orders'],
                ];
            } else {
                $date_array[$data->dimensions[1]->id] = [
                    'dt' => $data->dimensions[1]->id,
                    "earnings" => $data->metrics[0],
                    "orders" => $data->metrics[1],
                ];
            }
        }

        $earnings = $result->totals[0];
        $orders = $result->totals[1];
        $result_array = [
            'orders' => $orders,
            'earnings' => $earnings,
            'prices_history' => array_values($date_array),
            'orders_history' => array_values($date_array),
        ];

        return $result_array;
    }

    public function getOzonGeneralInfo(int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v2/product/info',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "sku": ' . $this->product_nm . '
            }',
            CURLOPT_HTTPHEADER => array(
                'Api-Key: ' . $api_key,
                'Client-Id: ' . $client_id,
                'Content-Type: application/json',
                'Cookie: abt_data=b89761760b8de852bf55c8ddb5c67e8d:832e12896ab719f7407396c381b35f3a3d643bbfa0faf7dc57be5fa479853d4abf58774b252ef432ca7222519c8c820723fbec410cfd0621dce2aa17bb312ad413cb085f1861a4f3740e3762e4d6ae0614e33e4c098957a50fd58f0af0978798359d6d40d544c115a7ab52adf63d59debd62021596171bf292470486511a05fb80c63d1c1b372b051eb5508704cdfd2479451d755c1f861efc363f5760900b1a40b1cf1f2d759ad9936fca12bfed8abd'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        $card = null;
        if (isset($result->result)) {
            $card = $result->result;
        }

        return $card;
    }
}
