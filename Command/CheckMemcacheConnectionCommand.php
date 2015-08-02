<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckMemcacheConnectionCommand
 */
class CheckMemcacheConnectionCommand extends AbstractCheckCommand
{
    /**
     * {@inheritDoc}
     */
    public function getScopeName()
    {
        return 'memcache-connection';
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return 'Check the connection of memcache.';
    }

    /**
     * {@inheritDoc}
     */
    protected function check()
    {
        if (!$this->getContainer()->hasParameter('memcache_servers')) {
            return false;
        }

        $connections = $this->getContainer()->getParameter('memcache_servers');

        foreach ($connections as $key => $connection) {
            $memcache = new \Memcache();
            if (!$memcache->connect($connection['host'], $connection['port'])) {
                return false;
            }

            $memcache->close();
        }

        return true;
    }
}
