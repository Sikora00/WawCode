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
    /**
     * @var DateResearcherServiceInterface
     */
    protected $dateResearcherServices;

    public function __construct(CrawlerServiceInterface $crawler, APIManager $APIManager, DateResearcherServiceInterface $dateResearcherService, CrawlerImageServiceInterface $crawlerImageService)
    {
        $this->crawler = $crawler;
        $this->apiManager = $APIManager;
        $this->dateResearcherServices = $dateResearcherService;
        $this->crawlerImageService = $crawlerImageService;
    }

    public function fetchEvents()
    {
        $begin = new \DateTime( "2008-01-01" );
        $end   = new \DateTime( "2008-12-31" );

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $newCrawler = $this->crawler->suck($i);
            $dataArray = $this->dateResearcherServices->removeFromArray( $this->dateResearcherServices->getFilteredDate($newCrawler));
            foreach ($dataArray as $data){
                $event = new HistoricalEvent();
                $image = $this->crawlerImageService->getImage($data['year'],$data['content']);
                $event->name = 'Historyczne Wydarzenie';
                $event->content = $data['content'];
                $event->day = $i->format('d');
                $event->month = $i->format('m');
                $event->year = $data['year'];
                $event->image = $image;
                $this->apiManager->createEventAction($event);
            }
        }
    }


}