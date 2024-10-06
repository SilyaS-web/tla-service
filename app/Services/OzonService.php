<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Log;

class OzonService
{

    public static function getProductInfo(int $product_nm, int $client_id, string $api_key)
    {
        $card = self::getGeneralInfo($product_nm, $client_id, $api_key);
        if (!isset($card->id)) return false;

        $product_attributes_without_names = self::getProductAttributestInfo($card->id, $client_id, $api_key);
        $attributes = self::getAttributestInfo($card->description_category_id, $card->type_id, $client_id, $api_key);
        $product_attributes = [];
        $product_brand = '';

        foreach ($product_attributes_without_names as $product_attribute) {
            foreach ($attributes as $attribute) {
                if ($attribute->id == $product_attribute->attribute_id && is_string($product_attribute->values[0]->value)) {
                    $product_attributes[] = [
                        'name' => $attribute->name,
                        'value' => $product_attribute->values[0]->value,
                    ];

                    if ($attribute->name == 'Бренд') {
                        $product_brand = $product_attribute->values[0]->value;
                    }

                    break;
                }
            }
        }
        $product_description = self::getProductDescription($card->id, $client_id, $api_key);

        return [
            'name' => $card->name,
            'brand' => $product_brand,
            'category' => '',
            'options' => $product_attributes,
            'description' => $product_description,
        ];
    }

    public static function getOrdersStats(int $nm, int $ozon_client_id, string $ozon_api_key)
    {
        $card = self::getGeneralInfo($nm, $ozon_client_id, $ozon_api_key);
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

    public static function getGeneralInfo(int $product_nm, int $client_id, string $api_key)
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
                "sku": ' . $product_nm . '
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
        if (!isset($result->result)) {
            return false;
        }

        return $result->result;
    }

    public static function getProductAttributestInfo(int $product_nm, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v3/products/info/attributes',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "filter" : {
                    "product_id": ["' . $product_nm . '"]
                },
                "limit": 1
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

        $decoded_response = json_decode($response);
        if (isset($decoded_response->result[0]->attributes)) {
            return $decoded_response->result[0]->attributes;
        }

        return [];
    }

    public static function getAttributestInfo(int $description_category_id, int $type_id, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v1/description-category/attribute',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "description_category_id": ' . $description_category_id . ',
                "type_id": ' . $type_id . '
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
        $decoded_response = json_decode($response);
        if (isset($decoded_response->result)) {
            return $decoded_response->result;
        }

        return [];
    }

    public static function getProductDescription(int $product_nm, int $client_id, string $api_key)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-seller.ozon.ru/v1/product/info/description',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "product_id": ' . $product_nm . '
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
        $decoded_response = json_decode($response);
        if (isset($decoded_response->description)) {
            return $decoded_response->description;
        }

        return null;
    }
}
