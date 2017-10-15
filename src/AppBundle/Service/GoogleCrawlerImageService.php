<?php
/**
 * Created by PhpStorm.
 * User: Nikere
 * Date: 15.10.2017
 * Time: 13:06
 */

namespace AppBundle\Service;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class GoogleCrawlerImageService implements CrawlerImageServiceInterface
{
    protected $siteBaseUrl = 'https://www.google.pl/search?hl=pl&tbm=isch&source=hp&biw=1858&bih=989&q=';

    protected function makeUrl(string $year, string $content): string
    {
        $contentWithoutSpaces = str_replace(" ", "+", $content);
        return $this->siteBaseUrl . $year . $contentWithoutSpaces;
    }

    protected function getImages(string $url): Crawler
    {
        $client = new Client();
        $crawler = $client->request('GET', $url);

        return $crawler;

    }

    protected function filterForImage(Crawler $crawler): array
    {
        $image = $crawler->filter('img')->each(function (Crawler $node, $i) {
            return $node->image()->getUri();
        });
        return $image;

    }

    function getImage(string $year, string $content) : string
    {
        $url = $this->makeUrl($year,$content);
        $crawler = $this->getImages($url);
        $array = $this->filterForImage($crawler);
        if(!isset($array[1])){
            return "";
        } else{
            return $array[1];
        }
    }
}