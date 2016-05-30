<?php

namespace Horrible\GearmanBundle\Job;

use GearmanWorker;
use GearmanJob;
use Horrible\GearmanBundle\Event\JobFailedEvent;
use Horrible\GearmanBundle\Event\JobFinishedEvent;
use Horrible\GearmanBundle\Event\JobStartedEvent;
use Horrible\GearmanBundle\Workload\SimpleWorkload;
use Horrible\GearmanBundle\Workload\WorkloadInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class JobsManager
 * @package Horrible\GearmanBundle\Job
 */
class JobsManager
{
    const DEFAULT_RETRIES = 1;

    /**
     * @var JobInterface[]
     */
    protected $jobs = [];

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var int
     */
    protected $retries = self::DEFAULT_RETRIES;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param int $retries
     */
    public function __construct(EventDispatcherInterface $dispatcher, $retries = self::DEFAULT_RETRIES)
    {
        $this->eventDispatcher = $dispatcher;
        $this->setRetries($retries);
    }

    /**
     * @param JobInterface $job
     */
    public function addJob(JobInterface $job)
    {
        $this->jobs[$job->getName()] = $job;
    }

    /**
     * @param GearmanWorker $gearmanWorker
     */
    public function registerJobs(GearmanWorker $gearmanWorker)
    {
        $jobNames = array_keys($this->jobs);

        foreach ($jobNames as $jobName) {
            $gearmanWorker->addFunction($jobName, function (GearmanJob $gearmanJob) use ($jobName) {
                $this->executeJob($gearmanJob, $jobName);
            });
        }

        unset($jobNames);
    }

    /**
     * @param GearmanJob $gearmanJob
     * @param $jobName
     */
    public function executeJob(GearmanJob $gearmanJob, $jobName)
    {
        if (!array_key_exists($jobName, $this->jobs)) {
            return;
        }

        $workload = new SimpleWorkload();
        $workload->setEncodedData($gearmanJob->workload());

        $this->dispatchJobStartedEvent($jobName, $workload);

        for ($i = 0; $i < $this->retries; $i++) {
            try {
                $jobResult = $this->jobs[$jobName]->execute($workload);
                $this->dispatchJobFinishedEvent($jobName, $workload, $jobResult);
                return;
            } catch (\Exception $exception) {
                $this->dispatchJobFailedEvent($jobName, $workload, $exception);
            }
        }

        unset($workload);
    }

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     */
    protected function dispatchJobStartedEvent($jobName, WorkloadInterface $workload)
    {
        $this->eventDispatcher->dispatch(
            JobStartedEvent::EVENT_NAME,
            new JobStartedEvent($jobName, $workload)
        );
    }

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     * @param \Exception $exception
     */
    protected function dispatchJobFailedEvent($jobName, WorkloadInterface $workload, \Exception $exception)
    {
        $this->eventDispatcher->dispatch(
            JobFailedEvent::EVENT_NAME,
            new JobFailedEvent($jobName, $workload, $exception)
        );
    }

    /**
     * @param string $jobName
     * @param WorkloadInterface $workload
     * @param mixed $jobResult
     */
    protected function dispatchJobFinishedEvent($jobName, WorkloadInterface $workload, $jobResult)
    {
        $this->eventDispatcher->dispatch(
            JobFinishedEvent::EVENT_NAME,
            new JobFinishedEvent($jobName, $workload, $jobResult)
        );
    }

    /**
     * Set amount of retries
     *
     * @param int $retries
     */
    protected function setRetries($retries)
    {
        $retries = intval($retries);
        if ($retries > 0) {
            $this->retries = $retries + 1;
        }
    }
}
