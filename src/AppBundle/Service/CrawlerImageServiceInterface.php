<?php
/**
 * Created by PhpStorm.
 * User: Nikere
 * Date: 15.10.2017
 * Time: 13:04
 */

namespace AppBundle\Service;


use Symfony\Component\DomCrawler\Crawler;

interface CrawlerImageServiceInterface
{
    function getImage(string $year, string $content) : string;

}