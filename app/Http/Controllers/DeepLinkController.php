<?php

namespace App\Http\Controllers;

use App\Models\DeepLink;
use App\Models\DeepLinkStat;
use App\Models\Project;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Dadata\DadataClient;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;
use Illuminate\Support\Facades\DB;

class DeepLinkController extends Controller
{
    public function index($link)
    {
        $deepLink = DeepLink::where("link", $link)->first();
        if (!$deepLink) {
            abort(404);
        }

        $this->createDeepLinkStats($deepLink->id);
        return redirect($deepLink->destination);
    }

    public function createDeepLinkStats($link_id)
    {
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $clientHints = ClientHints::factory($_SERVER);
        $dd = new DeviceDetector($userAgent, $clientHints);
        $dd->parse();

        $token = config('dadata.api_token');
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
        $user = Auth::user();

        $works = Work::where([['blogger_id', $user->id]])->get();
        $deepLinkStats = DeepLinkStat::whereIn('work_id', $works->pluck('id'))->getAttributewhere('created_at', '>=',  date('Y-m-d', time() - (86400 * 14)))
        ->groupBy('date')
        ->orderBy('date', 'DESC')
        ->get(array(
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as "total"')
        ));

        return response()->json($deepLinkStats, 200);
    }
}
