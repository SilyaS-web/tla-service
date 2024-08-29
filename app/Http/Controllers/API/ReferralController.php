<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReferralCodeResource;
use App\Models\DeepLink;
use App\Models\DeepLinkStat;
use App\Models\Project;
use App\Models\ReferralCode;
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

class ReferralController extends Controller
{
    public function index()
    {
        $referral_codes = ReferralCode::all();

        $data = [
            'referral_codes' => ReferralCodeResource::collection($referral_codes),
        ];

        return response()->json($data)->setStatusCode(200);
    }
}
