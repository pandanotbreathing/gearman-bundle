<?php

namespace Horrible\GearmanBundle\Event;

use Horrible\GearmanBundle\Workload\WorkloadInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class JobFinishedEvent
 * @package Horrible\GearmanBundle\Event
 */
class JobFinishedEvent extends Event
{
    const EVENT_NAME = 'horrible.event.job.finished';

    /**
     * @var string
     */
    protected $jobName;

    /**
     * @var WorkloadInterface
     */
    protected $workload;

    /**
     * @var mixed
     */
    protected $jobResult;

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     * @param mixed $jobResult
     */
    public function __construct($jobName, WorkloadInterface $workload, $jobResult)
    {
        $this->jobName = $jobName;
        $this->workload = $workload;
        $this->jobResult = $jobResult;
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
     * @return mixed
     */
    public function getJobResult()
    {
        return $this->jobResult;
    }
}
