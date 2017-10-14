<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Service\WikipediaCrawlerService;
use Goutte\Client;
use Symfony\Component\HttpFoundation\Response;

class CrawlerController extends BaseController
{

    public function testAction()
    {
        die('elo');
    }

    public function downloadDataAction()
    {
        $wikiCrawler = $this->get('app.crawler.wikipedia');
        $crawler = $wikiCrawler->suck(new \DateTime());
        return new Response($crawler->filterXPath('//body')->text());
    }
}