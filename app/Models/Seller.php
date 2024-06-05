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
        'platform',
        'platform_link',
        'organization_type',
        'is_achievement',
        'is_agent',
        'description',
        'wb_api_key',
        'finish_date',
        'remaining_tariff',
        'tariff',
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
        $valuation = $result->data->valuation;
        $feedbacksCount = $result->data->feedbacksCount;

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
            return 1;
        }

        $result = json_decode($response);
        $countUnanswered = $result->data->countUnanswered;

        return $countUnanswered;
    }

    public function getTotalFeedbacksWB()
    {
        if (empty($this->wb_api_key)) {
            return ['total' => 0, 'low' => 0, 'med' => 0, 'hig' => 0, 'avg' => 0, 'pr_low' => 0, 'pr_mid' => 0];
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://feedbacks-api.wildberries.ru/api/v1/feedbacks?isAnswered=true&take=4500&skip=0',
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

        $total = 0;
        $low = 0;
        $med = 0;
        $hig = 0;
        $total_valuation = 0;
        $feedbacks_by_nm = [];
        foreach ($result->data->feedbacks as $feedback) {
            $total += 1;
            $productValuation = $feedback->productValuation;
            $total_valuation += $productValuation;
            if (!isset($feedbacks_by_nm[$feedback->productDetails->nmId])) {
                $feedbacks_by_nm[$feedback->productDetails->nmId] = 1;
            } else {
                $feedbacks_by_nm[$feedback->productDetails->nmId] += 1;
            }

            if ($productValuation < 3) {
                $low++;
            } elseif ($productValuation > 3 && $productValuation < 4) {
                $med++;
            } else {
                $hig++;
            }
        }


        $pr_low = 0;
        $pr_mid = 0;
        foreach ($feedbacks_by_nm as $value) {
            if ($value < 5) {
                $pr_low++;
            } else if ($value < 15) {
                $pr_mid++;
            }
        }

        $avg = $total > 0 ? $total_valuation / $total : 0;

        return ['total' => $total, 'low' => $low, 'med' => $med, 'hig' => $hig, 'avg' => $avg, 'pr_low' => $pr_low, 'pr_mid' => $pr_mid];
    }
}
