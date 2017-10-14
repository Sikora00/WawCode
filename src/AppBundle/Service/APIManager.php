<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\Entity\HistoricalEvent;

class APIManager
{
    /**
     * @var string
     */
    protected $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function createEventAction(HistoricalEvent $event)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://api.github.com/repos/guzzle/guzzle', (array) $event);
        $response->getStatusCode();
    }
}