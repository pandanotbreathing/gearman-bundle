<?php

namespace Horrible\GearmanBundle\Command;

use Horrible\GearmanBundle\Worker\Worker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class WorkerCommand
 * @package Horrible\GearmanBundle\Command
 */
class WorkerCommand extends Command
{
    const COMMAND_NAME = 'horrible:worker:work';

    /**
     * @var Worker
     */
    protected $worker;

    /**
     * @param Worker $worker
     */
    public function __construct(Worker $worker)
    {
        parent::__construct();
        $this->worker = $worker;
    }

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->worker->work();
    }
}
