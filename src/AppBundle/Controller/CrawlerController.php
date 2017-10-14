<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use Goutte\Client;

class CrawlerController extends BaseController
{

    public function testAction()
    {
        die('elo');
    }

    public function downloadDataAction()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://github.com/login');

        // select the form and fill in some values
        $form = $crawler->selectButton('Sign in')->form();
        $form['login'] = 'symfonyfan';
        $form['password'] = 'anypass';

// submit that form
        $crawler = $client->submit($form);

    }
}