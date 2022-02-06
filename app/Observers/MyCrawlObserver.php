<?php

namespace App\Observers;

use Spatie\Crawler\CrawlObservers\CrawlObserver;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler as DomCrawler;

class MyCrawlObserver extends CrawlObserver
{
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null
    ): void
    {
        $data = [];

        $crawler = new DomCrawler((string)$response->getBody());

        $crawler = $crawler->filter("#root")->first();

        $data = $crawler->filter("div[data-testid='VehicleListItem']")
                    ->each(function (DomCrawler $node, $i) {
                        return $node->filter("h2")->first()->text();
                    });

        dd($data);
    }

    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    ): void
    {
        throw $requestException;
    }
}