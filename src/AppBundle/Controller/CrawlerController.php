<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use Goutte\Client;
use Service\WikipediaCrawlerService;

class CrawlerController extends BaseController
{

    public function testAction()
    {
        die('elo');
    }

    public function downloadDataAction()
    {
        /** @var WikipediaCrawlerService $crawlerService */
        $crawlerService = $this->get('app.crawler.wikipedia:');
        $url = $crawlerService->getSiteBaseUrl().$crawlerService->getDayURLModifier(new \DateTime());
        $client = new Client();
        $crawler = $client->request('GET', 'https://github.com/login');

        // select the form and fill in some values
        $form = $crawler->selectButton('Sign in')->form();
        $form['login'] = 'symfonyfan';
        $form['password'] = 'anypass';

        $crawler = $client->submit($form);

    }
}