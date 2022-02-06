<?php

namespace App\Http\Controllers;

use Spatie\Crawler\Crawler;
use Illuminate\Http\Request;
use App\Observers\MyCrawlObserver;
use Spatie\Browsershot\Browsershot;


class CrawlerController extends Controller
{
    public function crawl()
    {
        $url = "https://www.kijijiautos.ca/cars/used/";

        $browsershot = new Browsershot($url);

        $browsershot->setNodeBinary('C:\Users\Rahamat\AppData\Roaming\nvm\v16.13.2\node.exe')
                    ->setNpmBinary('C:\Users\Rahamat\AppData\Roaming\nvm\v16.13.2\npm.exe')
                    ->setChromePath("C:\Program Files\Google\Chrome\Application\chrome.exe");

        Crawler::create()
            ->setCrawlObserver(new MyCrawlObserver())
            ->setBrowserShot($browsershot)
            ->executeJavaScript()
            ->startCrawling($url);
    }
}
