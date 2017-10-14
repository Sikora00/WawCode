<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\HistoricalEvent;

class FetcherService
{
    /**
     * @var CrawlerServiceInterface
     */
    protected $crawler;
    /**
     * @var APIManager
     */
    protected $apiManager;

    public function __construct(CrawlerServiceInterface $crawler, APIManager $APIManager)
    {
        $this->crawler = $crawler;
        $this->apiManager = $APIManager;
    }

    public function fetchEvents()
    {
        $begin = new \DateTime( "2015-07-03" );
        $end   = new \DateTime( "2015-07-09" );

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $this->crawler->suck($i);
            $event = new HistoricalEvent();//TODO Create Entity From crawler
            $event->name = 'Test';
            $event->content = 'Test';
            $event->day = $i->format('d');
            $event->month = $i->format('m');
            $event->year = $i->format('y');
            $this->apiManager->createEventAction($event);
        }
    }


}