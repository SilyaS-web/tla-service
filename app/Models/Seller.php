<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory, SoftDeletes;

    public const TRIAL = 'trial';
    public const START = 'start';

    const TARIFFS = [
        self::TRIAL => [
            'quantity' => 1,
            'name' => 'Пробный'
        ],
        self::START => [
            'quantity' => 500,
            'name' => 'Начальный'
        ],
    ];

    protected $fillable = [
        'user_id',
        'organization_name',
        'organization_type',
        'is_achievement',
        'is_agent',
        'description',
        'inn',
        'finish_date',
        'remaining_tariff',
        'tariff',
        'wb_link',
        'wb_api_key',
        'ozon_link',
        'ozon_api_key',
        'ozon_client_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function projects()
    // {
    //     return $this->hasManyThrough(
    //         Deployment::class,
    //         Environment::class,
    //         'project_id', // Foreign key on the environments table...
    //         'environment_id', // Foreign key on the deployments table...
    //         'id', // Local key on the projects table...
    //         'id' // Local key on the environments table...
    //     );
    // }

    public function getNMfromWB()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://suppliers-api.wildberries.ru/content/v2/get/cards/list?locale=ru',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "settings": {
                    "filter": {
                     "withPhoto": -1
                    },
                    "cursor": {
                    "limit": 100
                    }
                }
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: ' . $this->wb_api_key,
            ),
        ));

        $response = curl_exec($curl);

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if (200 != $http_code) {
            return 0;
        }

        $nm = [];
        $result = json_decode($response);
        foreach ($result as $product_card) {
            $nm[] = $product_card->nmID;
        }
        dd($result);
        return $nm;
    }

    public function getNMStatWB($nm)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://feedbacks-api.wildberries.ru/api/v1/feedbacks/products/rating/nmid?nmId=' . $nm,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: ' . $this->wb_api_key,
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if (200 != $http_code) {
            return [];
        }

        $result = json_decode($response);
        $valuation = $result->data->valuation ?? 0;
        $feedbacksCount = $result->data->feedbacksCount ?? 0;

        return ['valuation' => $valuation, 'feedbacksCount' => $feedbacksCount];
    }

    public function getCountUnansweredWB()
    {

        if (empty($this->wb_api_key)) {
            return 0;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://feedbacks-api.wildberries.ru/api/v1/feedbacks/count-unanswered',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: ' . $this->wb_api_key,
            ),
        ));

        $response = curl_exec($curl);
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if (200 != $http_code) {
            return 0;
        }

        $result = json_decode($response);
        $countUnanswered = $result->data->countUnanswered;

        return $countUnanswered;
    }

    public function getWBFeedbackStats()
    {
        if (empty($this->wb_api_key)) {
            return ['total' => 0, 'avg' => 0, 'low' => [], 'mid' => [], 'hig' => [], 'pr_low' => [], 'pr_mid' => [], 'percent' => 0];
        }

        $total = 0;
        $avg = 0;
        $low = [];
        $mid = [];
        $hig = [];
        $pr_low = [];
        $pr_mid = [];
        $total_valuation = 0;
        $products_feedbacks = [];
        $percent = 0;
        $feedbacks = $this->curlWBFeedbacks();

        if (empty($feedbacks)) {
            return ['total' => 0, 'avg' => 0, 'low' => [], 'mid' => [], 'hig' => [], 'pr_low' => 0, 'pr_mid' => [], 'percent' => 0];
        }

        foreach ($feedbacks as $feedback) {
            $total += 1;
            $productValuation = $feedback->productValuation;
            $total_valuation += $productValuation;

            $products_feedbacks[$feedback->productDetails->nmId]['count'] = ($products_feedbacks[$feedback->productDetails->nmId]['count'] ?? 0) + 1;
            $products_feedbacks[$feedback->productDetails->nmId]['valution_sum'] = ($products_feedbacks[$feedback->productDetails->nmId]['valution_sum'] ?? 0) + $productValuation;
        }

        foreach ($products_feedbacks as $id => $feedback_stat) {
            if ($feedback_stat['count'] < 25) {
                $pr_low[] = $id;
            } else if ($feedback_stat['count'] < 50) {
                $pr_mid[] = $id;
            }

            $product_avg_valution = $feedback_stat['valution_sum'] / ($feedback_stat['count'] == 0 ? 1 : $feedback_stat['count']);
            if ($product_avg_valution < 4.2) {
                $low[] = $id;
            } else if ($product_avg_valution < 4.5) {
                $mid[] = $id;
            } else {
                $hig[] = $id;
            }
        }

        $avg = $total > 0 ? $total_valuation / $total : 0;
        
        if ($avg <= 4.5) {
            $percent = 11.1 * $avg;
        } else if ($avg <= 4.7) {
            $percent = 15.9 * $avg;
        } else if ($avg <= 4.85) {
            $percent = 18 * $avg;
        } else if ($avg <= 4.92) {
            $percent = 19 * $avg;
        } else {
            $percent = 20 * $avg;
        }

        return [
            'total' => $total,
            'avg' => $avg,
            'low' => $low,
            'mid' => $mid,
            'hig' => $hig,
            'pr_low' => $pr_low,
            'pr_mid' => $pr_mid,
            'percent' => $percent,
        ];
    }

    public function curlWBFeedbacks()
    {
        $take = 5000;
        $skip = 0;
        $is_answered = 'true';
        $feedbacks = [];
        $next = true;
        do {
            usleep(1100);
            $curl = curl_init();
            $url = "https://feedbacks-api.wildberries.ru/api/v1/feedbacks?isAnswered=" . $is_answered . "&take=" . $take. "&skip=" . $skip;
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization: ' . $this->wb_api_key,
                ),
            ));

            $response = curl_exec($curl);
            $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            $skip += 5000;
            if ($http_code == 200) {
                $result = json_decode($response);
                $new_feedbacks = $result->data->feedbacks;

                if (count($new_feedbacks) > 0) {
                    $feedbacks = array_merge($feedbacks, $new_feedbacks);
                } else {
                    if ($is_answered == 'true') {
                        $is_answered = 'false';
                        $skip = 0;
                    } else {
                        $next = false;
                    }
                }
            } else {
                $next = false;
            }
        } while ($next);

        return $feedbacks;
    }
}
