<?php

namespace App\Http\Controllers;

use App\Models\DeepLink;
use App\Models\DeepLinkStat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Dadata\DadataClient;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

class DeepLinkController extends Controller
{
    public function index($link)
    {
        $deepLink = DeepLink::where("link", $link)->first();
        if (!$deepLink) {
            abort(404);
        }

        $this->createDeepLinkStats($deepLink->id);
        redirect($deepLink->destination);
    }

    public function createDeepLinkStats($link_id)
    {
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $clientHints = ClientHints::factory($_SERVER);
        $dd = new DeviceDetector($userAgent, $clientHints);
        $dd->parse();

        $token = env('DADATA_API_TOKEN', null);
        $dadata = new DadataClient($token, null);
        $geoData = $dadata->iplocate($_SERVER['REMOTE_ADDR']);

        DeepLinkStat::create([
            'link_id' => $link_id,
            'datatime' => date('Y-m-d'),
            'device' => $dd->getDeviceName(),
            'operating_system' => $dd->getOs('name') ?? null,
            'country' => $geoData['data']['country'] ?? null,
            'federal_district' => $geoData['data']['federal_district'] ?? null,
            'region' => $geoData['data']['region'] ?? null,
            'city' => $geoData['data']['city'] ?? null,
            'referrer' => $_SERVER['HTTP_REFERER'] ?? null,
            'is_bot' => $dd->isBot(),
            'is_mobile' => $dd->isMobile(),
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'work_id' => 'exists:works,id',
            'destination' => 'required|url',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();
        $validated['link'] = Str::random(10);

        while (DeepLink::where("link", $validated['link'])->first()) {
            $validated['link'] = Str::random(10);
        }

        $deepLink = DeepLink::create($validated);
        print_r($deepLink->link);
    }

    public function stats()
    {
        $deepLinkStats = DeepLinkStat::get();
        print_r($deepLinkStats);
    }
}
