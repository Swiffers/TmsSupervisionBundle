<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckConnectionDoctrineODMCommand
 *
 * @package Tms\Bundle\SupervisionBundle\Command
 */
class CheckConnectionDoctrineODMCommand extends ContainerAwareCommand
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('check:doctrine:mongodb-connection')
            ->setDescription('Check the connection of MongoDB.');
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connections = $this->getContainer()->get('doctrine_mongodb')->getConnections();

        foreach ($connections as $key => $connection) {
            try {
                $connection->connect();
            } catch (\Exception $e) {
                $output->writeln($e->getMessage());

                return 1;
            }

            $output->writeln(sprintf(
                'mongodb://%s <info>%s</info> connection ok!',
                $connection,
                $key
            ));

            $connection->close();
        }

        return 0;
    }
}
