<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public const FEEDBACK = 'feedback';

    public const TYPES = [
        self::FEEDBACK,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_type',
        'project_name',
        'product_name',
        'product_nm',
        'product_link',
        'product_price',
        'status',
        'seller_id'
    ];

    public function executor()
    {
    }

    public function projectFiles()
    {
        return $this->hasMany(ProjectFile::class, 'source_id', 'id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'project_id', 'id');
    }

    public function countActiveBloggers()
    {
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
            'referer: https://www.wildberries.ru/catalog/'. $this->product_nm .'/detail.aspx',
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

        curl_close($ch);

        return $response;
    }
}
