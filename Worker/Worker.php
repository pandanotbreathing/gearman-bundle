<?php

namespace Horrible\GearmanBundle\Worker;

use GearmanWorker;
use Horrible\GearmanBundle\Configurator\GearmanConfigurator;
use Horrible\GearmanBundle\Job\JobsManager;

/**
 * Class Worker
 * @package Horrible\GearmanBundle\Worker
 */
class Worker
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var GearmanWorker
     */
    protected $gearmanWorker;

    /**
     * @var JobsManager
     */
    protected $jobsManager;

    /**
     * @var GearmanConfigurator
     */
    protected $configurator;

    /**
     * @param GearmanWorker $gearmanWorker
     * @param JobsManager $jobsManager
     * @param GearmanConfigurator $configurator
     */
    public function __construct(
        GearmanWorker $gearmanWorker,
        JobsManager $jobsManager,
        GearmanConfigurator $configurator
    ) {
        $this->gearmanWorker = $gearmanWorker;
        $this->jobsManager = $jobsManager;
        $this->configurator = $configurator;
        $this->configurator->configure($this->gearmanWorker);
        $this->generateId();
        $this->setJobsManagerWorkerId();
    }

    public function work()
    {
        $this->registerJobs();
        while ($this->gearmanWorker->work()) {
        }
    }

    /**
     * Registers all available jobs from the jobs manager
     */
    protected function registerJobs()
    {
        $this->jobsManager->registerJobs($this->gearmanWorker);
    }

    /**
     * Generates worker id
     */
    protected function generateId()
    {
        $this->id = uniqid();
    }

    /**
     * Sets current worker id to the jobs manager
     */
    protected function setJobsManagerWorkerId()
    {
        $this->jobsManager->setWorkerId($this->id);
    }
}
