<?php

namespace Tms\Bundle\SupervisionBundle\Command;

/**
 * Class CheckConnectionDoctrineODMCommand
 */
class CheckConnectionDoctrineODMCommand extends AbstractCheckCommand
{
    /**
     * {@inheritDoc}
     */
    public function getScopeName()
    {
        return 'doctrine:mongodb-connection';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return 'Check the connection of MongoDB.';
    }

    /**
     * {@inheritDoc}
     */
    protected function check()
    {
        if (!$this->getContainer()->has('doctrine_mongodb')) {
            return false;
        }

        $connections = $this->getContainer()->get('doctrine_mongodb')->getConnections();

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
