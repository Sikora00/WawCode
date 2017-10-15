<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Service\GoogleCrawlerImageService;
use AppBundle\Service\WikipediaCrawlerService;
use AppBundle\Service\WikipediaDateResearcherService;
use Symfony\Component\HttpFoundation\Response;

class CrawlerController extends BaseController
{

    public function testAction()
    {
        die('elo');
    }

    public function downloadDataAction()
    {
        /**
         * @var WikipediaDateResearcherService $wikidata
         * @var WikipediaCrawlerService $wikiCrawler
         * @var GoogleCrawlerImageService $googleCrawler
         */
        $googleCrawler = $this->get('app.crawlerImage.google');
        $img = $googleCrawler->getImage('1918','– PPS zorganizowała w Warszawie wielką demonstrację przeciwko rządom Rady Regencyjnej.');
        return new Response($img);
    }
}