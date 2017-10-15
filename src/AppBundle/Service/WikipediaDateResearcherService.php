<?php
declare(strict_types=1);

namespace AppBundle\Service;


use Symfony\Component\DomCrawler\Crawler;

class WikipediaDateResearcherService implements DateResearcherServiceInterface
{

    function getFilteredDate(Crawler $crawler) : array
    {
        $date = $crawler->filter('li')->each(function (Crawler $node, $i) {
            if ((strstr(strtolower($node->text()), 'warszawa') || strstr(strtolower($node->text()), 'w warszawie') || strstr(strtolower($node->text()), 'warszawskiego')) && $node->children()->filter('ul')->count() == 0) {
                return [
                    'content' => $this->removeYearFromString($node->text()),
                    'year' => $this->takeYear($node),
                ];
            } else {
                return null;
            }
        });
        return $date;
    }

    function removeFromArray(array $array) : array
    {
        return array_filter($array);
    }

    protected function takeYear(Crawler $node)
    {
        $text = $node->text();
        $parentText = $node->parents()->parents()->text();
        if (preg_match('/\b\d{4}\b/', $text, $matches)) {
            $year = $matches[0];
        } else if (preg_match('/\b\d{4}\b/', $parentText, $matches)) {
            $year = $matches[0];
        } else {
            $data = new \DateTime();
            $year = $data->format('Y');
        }
        return $year;
    }

    protected function removeYearFromString($string){
        return preg_replace("/\b\d{4}\b/", "", $string);
    }
}