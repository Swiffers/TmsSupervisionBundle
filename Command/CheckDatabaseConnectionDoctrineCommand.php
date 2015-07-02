<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckDatabaseConnectionDoctrineCommand
 *
 * @package Tms\Bundle\SupervisionBundle\Command
 */
class CheckDatabaseConnectionDoctrineCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('check:doctrine:database-connection')
            ->setDescription('Check the connection of database.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connections = $this->getContainer()->get('doctrine')->getConnections();

        foreach ($connections as $key => $connection) {
            try {
                $connection->connect();
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());

                return 1;
            }
            $params = $connection->getParams();
            $output->writeln(sprintf(
                '%s://%s:%s/<info>%s</info> connection ok!',
                $params['driver'],
                $params['host'],
                $params['port'],
                $params['dbname']
            ));

            $connection->close();
        }

        return 0;
    }
}
