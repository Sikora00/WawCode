<?php
declare(strict_types=1);


namespace AppBundle\Service;




interface CrawlerServiceInterface
{

    function getFullUrl(\DateTime $date);

    function suck(\DateTime $date);

}