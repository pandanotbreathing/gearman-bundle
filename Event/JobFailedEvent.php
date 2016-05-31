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
     * @var null|string
     */
    protected $workerId;

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     * @param \Exception $exception
     * @param string|null $workerId
     */
    public function __construct($jobName, WorkloadInterface $workload, \Exception $exception, $workerId = null)
    {
        $this->jobName = $jobName;
        $this->workload = $workload;
        $this->exception = $exception;
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
     * @return \Exception
     */
    public function getException()
    {
        return $this->exception;
    }

    /**
     * @return null|string
     */
    public function getWorkerId()
    {
        return $this->workerId;
    }
}
