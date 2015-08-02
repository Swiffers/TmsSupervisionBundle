<?php

namespace Tms\Bundle\SupervisionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class AbstractCheckCommand
 */
abstract class AbstractCheckCommand extends ContainerAwareCommand
{
    /**
     * @return string
     */
    abstract public function getScopeName();

    /**
     * @return boolean
     */
    abstract protected function check();

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName(sprintf('check:%s', $this->getScopeName()))
            ->setDescription($this->getDescription())
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $isOk = $this->check();
        if (!is_bool($isOk)) {
            throw new \RuntimeException("Invalid check return value");
        }

        if ($isOk) {
            $output->writeln(sprintf(
                '<info>%s [ok]</info>',
                $this->getScopeName()
            ));

            return 0;
        }

        $output->writeln(sprintf(
            '<error>%s [ko]</error>',
            $this->getScopeName()
        ));

        return 1;
    }
}
