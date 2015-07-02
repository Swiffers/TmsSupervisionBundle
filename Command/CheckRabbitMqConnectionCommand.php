<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckRabbitMqConnectionCommand
 *
 * @package Tms\Bundle\SupervisionBundle\Command
 */
class CheckRabbitMqConnectionCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('check:rabbitmq-connection')
            ->setDescription('Check the default connection of rabbitmq.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $connection = $this->getContainer()->get('old_sound_rabbit_mq.connection.default');
            $connection->reconnect();
        } catch (\Exception $e) {
            $output->writeln($e->getMessage());

            return 1;
        }

        $output->writeln(sprintf(
            '%s <info>default</info> connection ok!',
            'rabbitmq'
        ));

        $connection->close();

        return 0;
    }
}
