<?php

namespace App\Http\Controllers;

use App\Models\DeepLink;
use Dadata\DadataClient;
use Illuminate\Http\Request;
use UserAgentParser\Provider;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

class DeepLinkController extends Controller
{
    public function index($link)
    {
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
        AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

        $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
        $clientHints = ClientHints::factory($_SERVER); // client hints are optional

        $dd = new DeviceDetector($userAgent, $clientHints);

        // OPTIONAL: Set caching method
        // By default static cache is used, which works best within one php process (memory array caching)
        // To cache across requests use caching in files or memcache
        // $dd->setCache(new Doctrine\Common\Cache\PhpFileCache('./tmp/'));

        // OPTIONAL: Set custom yaml parser
        // By default Spyc will be used for parsing yaml files. You can also use another yaml parser.
        // You may need to implement the Yaml Parser facade if you want to use another parser than Spyc or [Symfony](https://github.com/symfony/yaml)
        // $dd->setYamlParser(new DeviceDetector\Yaml\Symfony());

        // OPTIONAL: If called, getBot() will only return true if a bot was detected  (speeds up detection a bit)
        // $dd->discardBotInformation();

        // OPTIONAL: If called, bot detection will completely be skipped (bots will be detected as regular devices then)
        // $dd->skipBotDetection();

        $dd->parse();

        if ($dd->isBot()) {
            // handle bots,spiders,crawlers,...
            print_r($dd->getBot());
        } else {
            print_r($dd->getClient()); // holds information about browser, feed reader, media player, ...
            print_r($dd->getOs());
            print_r($dd->getDeviceName());
            print_r($dd->getBrandName());
            print_r($dd->getModel());
            $token = env('DADATA_API_TOKEN',null);
            $dadata = new DadataClient($token, null);
            $result = $dadata->iplocate($_SERVER['REMOTE_ADDR']);
            print_r($result);
        }
        print_r($_SERVER);
        die();
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
