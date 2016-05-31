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
     * @var null|string
     */
    protected $workerId;

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     * @param string|null $workerId
     */
    public function __construct($jobName, WorkloadInterface $workload, $workerId = null)
    {
        $this->jobName = $jobName;
        $this->workload = $workload;
        $this->workerId = $workerId;
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

    /**
     * @return null|string
     */
    public function getWorkerId()
    {
        return $this->workerId;
    }
}
