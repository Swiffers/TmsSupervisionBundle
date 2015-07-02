<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckMemcacheConnectionCommand
 *
 * @package Tms\Bundle\SupervisionBundle\Command
 */
class CheckMemcacheConnectionCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('check:memcache-connection')
            ->setDescription('Check the connection of memcache.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connections = $this->getContainer()->getParameter('memcache_servers');

        foreach ($connections as $key => $connection) {
            $memcache = new \Memcache();
            if (!$memcache->connect($connection['host'], $connection['port'])) {
                return 1;
            }

            $output->writeln(sprintf(
                '<info>%s</info>://%s:%s connection ok!',
                $key,
                $connection['host'],
                $connection['port']
            ));

            $memcache->close();
        }

        return 0;
    }
}
