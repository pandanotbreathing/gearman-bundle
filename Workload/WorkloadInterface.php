<?php

namespace Horrible\GearmanBundle\Workload;

/**
 * Interface WorkloadInterface
 * @package Horrible\GearmanBundle\Workload
 */
interface WorkloadInterface
{
    /**
     * @return string
     */
    public function getEncodedData();

    /**
     * @return mixed
     */
    public function getDecodedData();
}
