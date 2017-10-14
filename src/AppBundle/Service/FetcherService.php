<?php
declare(strict_types=1);

namespace AppBundle\Service;

class FetcherService
{
    /**
     * @var CrawlerServiceInterface
     */
    protected $crawler;

    public function __construct(CrawlerServiceInterface $crawler)
    {
        $this->crawler = $crawler;
    }

    public function fetchEvents()
    {
        $begin = new \DateTime( "2015-07-03" );
        $end   = new \DateTime( "2015-07-09" );

        for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $this->crawler->suck($i);
        }
    }


}