<?php
declare(strict_types=1);

namespace AppBundle\Controller;

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
         */
        $wikiCrawler = $this->get('app.crawler.wikipedia');
        $crawler = $wikiCrawler->suck(new \DateTime());
        $wikidata = $this->get('app.dataResearcher.wikipedia');
        $data = $wikidata->removeFromArray( $wikidata->getFilteredDate($crawler));
        return new Response($data);
    }
}