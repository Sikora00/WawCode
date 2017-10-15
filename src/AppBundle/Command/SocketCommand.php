<?php
/**
 * Created by PhpStorm.
 * User: Nikere
 * Date: 15.10.2017
 * Time: 10:17
 */
namespace AppBundle\Command;

use AppBundle\Message\ChatMessageComponent;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SocketCommand extends Command
{
    protected function configure()
    {
        $this->setName('sockets:start')
            ->setHelp("Starts the chat socket demo")
            ->setDescription('Starts the chat socket demo')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Chat socket',// A line
            '============',// Another line
            'Starting chat, open your browser.',// Empty line
        ]);

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatMessageComponent()
                )
            ),
            8080
        );

        $server->run();
    }

}