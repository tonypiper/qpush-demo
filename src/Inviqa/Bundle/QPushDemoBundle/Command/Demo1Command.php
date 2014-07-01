<?php
/**
 * Created by PhpStorm.
 * User: tpiper
 * Date: 01/07/2014
 * Time: 08:31
 */

namespace Inviqa\Bundle\QPushDemoBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Demo1Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:demo1')
            ->setDescription('Demo 1');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // add a job to the queue
        $this->getContainer()->get('logger')->info(str_repeat('-', 20));

        for ($messageId = 1; $messageId < 10; $messageId++) {
            $message = array('content' => 'message ' . $messageId);
            $this->getContainer()->get('uecode_qpush')->get('queue1')->publish($message);

            $this->getContainer()->get('logger')->info('posted message ' . $messageId);
            $output->writeln('posted message ' . $messageId);
        }
    }
} 