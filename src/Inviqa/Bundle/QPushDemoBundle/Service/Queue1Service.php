<?php
/**
 * Created by PhpStorm.
 * User: tpiper
 * Date: 01/07/2014
 * Time: 08:42
 */

namespace Inviqa\Bundle\QPushDemoBundle\Service;


use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Uecode\Bundle\QPushBundle\Event\MessageEvent;

class Queue1Service
{

    /**
     * @var \Symfony\Component\HttpKernel\Log\LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onMessageReceived(MessageEvent $event)
    {
        // simulate failure


        $message = $event->getMessage();
        $messageId = $message->getId();
        $content = $message->getBody();

        if (rand(1, 10) > 7) {
            $this->logger->info('simulating failure for message '.$messageId);
            throw new \Exception('simulating random failure for message '.$messageId);
        }


        $this->logger->info(sprintf('got a message with id=%s, body=%s', $messageId, json_encode($content)));
        sleep(1);
        $this->logger->info('finished processing message');
    }
} 