<?php
declare(strict_types=1);

namespace AppBundle\Service;

use Goutte\Client;

abstract class AbstractCrawlerService implements CrawlerServiceInterface
{
    protected $siteBaseUrl;

    abstract function getSiteBaseUrl(): string ;

    abstract function getDayURLModifier(\DateTime $date): string ;

    public function suck(\DateTime $date)
    {
        $url = $this->getSiteBaseUrl().$this->getDayURLModifier($date);
        $client = new Client();
        $crawler = $client->request('GET', $url);

        return $crawler;
    }

}