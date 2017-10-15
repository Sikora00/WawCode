<?php
/**
 * Created by PhpStorm.
 * User: Nikere
 * Date: 14.10.2017
 * Time: 15:01
 */

namespace AppBundle\Service;


use Symfony\Component\DomCrawler\Crawler;

interface DateResearcherServiceInterface
{
    function getFilteredDate(Crawler $crawler): array ;

    function removeFromArray(array $array): array ;

}