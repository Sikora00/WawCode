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
        $url = $this->apiUrl . '/event';
        $content = '{
	        "name":"' . $event->name . '" ,
	        "content": "' . $event->content . '",
	        "day": "' . $event->day . '",
	        "month": "' . $event->month . '",
	        "year": "' . $event->year . '",
	        "imageUrl": "'.$event->image.'"
}';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($status != 200) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }


        curl_close($curl);

        $response = json_decode($json_response, true);
    }
}