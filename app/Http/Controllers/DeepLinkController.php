<?php

namespace App\Http\Controllers;

use App\Models\DeepLink;
use Illuminate\Http\Request;

class DeepLinkController extends Controller
{
    public function index($link) {
        // $deepLink = DeepLink::where("link", $link)->first();
        // if (!$deepLink) {
        //     abort(404);
        // }

        // $stat = [
        //     'link_id' => $deepLink->id,
        //     'datatime' => date('Y-m-d'),
        //     'device' => $deepLink->id,
        //     'link_id' => $deepLink->id,

        // ];
        echo "<pre>";
        if ($link == 'browser') {
            $browser = get_browser(null, true);
            print_r($browser);
        } else if ($link == 'link') {
            echo "<a href='http://h406133820.nichost.ru/lnk/123'>123</a>";
        } else {
            phpinfo();
        }
    }
}
