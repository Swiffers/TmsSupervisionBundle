<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckRabbitMqConnectionCommand
 */
class CheckRabbitMqConnectionCommand extends AbstractCheckCommand
{
    /**
     * {@inheritDoc}
     */
    public function getScopeName()
    {
        return 'rabbitmq-connection';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return 'Check the default connection of rabbitmq.';
    }

    /**
     * {@inheritDoc}
     */
    protected function check()
    {
        if (!$this->getContainer()->has('old_sound_rabbit_mq.connection.default')) {
            return false;
        }

        try {
            $connection = $this->getContainer()->get('old_sound_rabbit_mq.connection.default');
            $connection->reconnect();
        } catch (\Exception $e) {
            return false;
        }

        $connection->close();

        return true;
    }
}
