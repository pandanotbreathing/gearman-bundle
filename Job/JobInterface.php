<?php

namespace Horrible\GearmanBundle\Job;

use Horrible\GearmanBundle\Workload\WorkloadInterface;

/**
 * Interface JobInterface
 * @package Horrible\GearmanBundle\Job
 */
interface JobInterface
{
    const TAG_NAME = 'horrible.gearman.job';

    /**
     * @param WorkloadInterface $workload
     */
    public function execute(WorkloadInterface $workload);

    /**
     * @return string
     */
    public function getName();
}
