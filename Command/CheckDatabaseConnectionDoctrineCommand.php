<?php

namespace Tms\Bundle\SupervisionBundle\Command;

/**
 * Class CheckDatabaseConnectionDoctrineCommand\
 */
class CheckDatabaseConnectionDoctrineCommand extends AbstractCheckCommand
{
    /**
     * {@inheritDoc}
     */
    public function getScopeName()
    {
        return 'doctrine:database-connection';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return 'Check the connection of database.';
    }

    /**
     * {@inheritDoc}
     */
    protected function check()
    {
        if (!$this->getContainer()->has('doctrine')) {
            return false;
        }

        $connections = $this->getContainer()->get('doctrine')->getConnections();

        foreach ($connections as $key => $connection) {
            try {
                $connection->connect();
            } catch (\Exception $e) {
                return false;
            }

            $connection->close();
        }

        return true;
    }
}
