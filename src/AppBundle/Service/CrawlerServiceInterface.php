<?php
declare(strict_types=1);


namespace Service;




interface CrawlerServiceInterface
{
    function getSiteBaseUrl(): string ;

    function getDayURLModifier(\DateTime $date): string ;

}