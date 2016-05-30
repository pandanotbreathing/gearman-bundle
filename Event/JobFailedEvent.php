<?php

namespace Horrible\GearmanBundle\Event;

use Horrible\GearmanBundle\Workload\WorkloadInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class JobFailedEvent
 * @package Horrible\GearmanBundle\Event
 */
class JobFailedEvent extends Event
{
    const EVENT_NAME = 'horrible.event.job.failed';

    /**
     * @var string
     */
    protected $jobName;

    /**
     * @var WorkloadInterface
     */
    protected $workload;

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     * @param \Exception $exception
     */
    public function __construct($jobName, WorkloadInterface $workload, \Exception $exception)
    {
        $this->jobName = $jobName;
        $this->workload = $workload;
        $this->exception = $exception;
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
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }
}
