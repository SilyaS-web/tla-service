<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\JsonResponse;

class get_wild_data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get_wild_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $products = $this->getProductList(1);
        $products = array_merge($products, $this->getProductList(2));
        $seller_data = [];

        foreach ($products as $product) {
            $productData = $this->getProductData($product->slug);
            if (!empty($productData->seller)) {
                $seller_data[$productData->seller->email] = [$productData->seller->email, $productData->seller->name];
            }
        }

        $this->saveSellerDataToCsv($seller_data);
    }

    private function getProductList($page = 1): array
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://prod.wildsales.io/api/v1/catalog/products?sort=-deals_count%2C-created_at&include=images&page[size]=100&page[number]=' . $page,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response)->data ?? [];
    }

    private function getProductData(string $slug): ?\stdClass
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://prod.wildsales.io/api/v1/catalog/products/' . $slug . '?include=categories%2Cimages%2Cseller',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response)->data ?? null;
    }

    private function saveSellerDataToCsv($seller_data): bool
    {
        // Проверяем, есть ли данные для сохранения
        if (empty($seller_data)) {
            return false;
        }

        // Открываем файл для записи
        $file = fopen('sellers.csv', 'w');

        // Добавляем заголовки CSV
        fputcsv($file, ['Email', 'Name']);

        // Записываем данные
        foreach ($seller_data as $seller) {
            fputcsv($file, $seller);
        }

        // Закрываем файл
        fclose($file);

        return true;
    }
}
