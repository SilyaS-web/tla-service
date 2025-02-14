<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int $link_id
 * @property string|null $datatime
 * @property string|null $device
 * @property string|null $operating_system
 * @property string|null $country
 * @property string|null $federal_district
 * @property string|null $region
 * @property string|null $city
 * @property string|null $referrer
 * @property int|null $is_bot
 * @property int|null $is_mobile
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereDatatime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereDevice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereFederalDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereIsBot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereIsMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereLinkId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereOperatingSystem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereReferrer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeepLinkStat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeepLinkStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'datetime',
        'device',
        'operating_system',
        'country',
        'federal_district',
        'region',
        'city',
        'referrer',
        'is_bot',
        'is_mobile',
    ];
}
