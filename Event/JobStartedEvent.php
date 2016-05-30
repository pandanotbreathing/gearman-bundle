<?php

namespace Horrible\GearmanBundle\Event;

use Horrible\GearmanBundle\Workload\WorkloadInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class JobStartedEvent
 * @package Horrible\GearmanBundle\Event
 */
class JobStartedEvent extends Event
{
    const EVENT_NAME = 'horrible.event.job.started';

    /**
     * @var string
     */
    protected $jobName;

    /**
     * @var WorkloadInterface
     */
    protected $workload;

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     */
    public function __construct($jobName, WorkloadInterface $workload)
    {
        $this->jobName = $jobName;
        $this->workload = $workload;
    }

    /**
     * @return string
     */
    public function getJobName()
    {
        return $this->jobName;
    }

    /**
     * @return WorkloadInterface
     */
    public function getWorkload()
    {
        return $this->workload;
    }
}
