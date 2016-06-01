<?php

namespace Horrible\GearmanBundle\Client;

use Horrible\GearmanBundle\Configurator\GearmanConfigurator;
use Horrible\GearmanBundle\Workload\WorkloadInterface;
use GearmanClient;

/**
 * Class Client
 * @package Horrible\GearmanBundle\Client
 */
class Client
{
    /**
     * @var \GearmanClient
     */
    protected $gearmanClient;

    /**
     * @var GearmanConfigurator
     */
    protected $gearmanConfigurator;

    /**
     * @param \GearmanClient $gearmanClient
     * @param GearmanConfigurator $configurator
     */
    public function __construct(GearmanClient $gearmanClient, GearmanConfigurator $configurator)
    {
        $this->gearmanClient = $gearmanClient;
        $this->gearmanConfigurator = $configurator;
        $this->gearmanConfigurator->configure($this->gearmanClient);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doHigh($functionName, WorkloadInterface $workload = null, $uniqueId = null)
    {
        return $this->gearmanClient->doHigh($functionName, $this->getWorkloadEncodedData($workload), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doNormal($functionName, WorkloadInterface $workload = null, $uniqueId = null)
    {
        return $this->gearmanClient->doNormal($functionName, $this->getWorkloadEncodedData($workload), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doLow($functionName, WorkloadInterface $workload = null, $uniqueId = null)
    {
        return $this->gearmanClient->doLow($functionName, $this->getWorkloadEncodedData($workload), $uniqueId);
    }

    /**
     * @return string
     */
    public function doJobHandle()
    {
        return $this->gearmanClient->doJobHandle();
    }

    /**
     * @return array
     */
    public function doStatus()
    {
        return $this->gearmanClient->doStatus();
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doBackground($functionName, WorkloadInterface $workload = null, $uniqueId = null)
    {
        return $this->gearmanClient->doBackground($functionName, $this->getWorkloadEncodedData($workload), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doHighBackground($functionName, WorkloadInterface $workload = null, $uniqueId = null)
    {
        return $this->gearmanClient->doHighBackground(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $uniqueId
        );
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doLowBackground($functionName, WorkloadInterface $workload = null, $uniqueId = null)
    {
        return $this->gearmanClient->doLowBackground(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $uniqueId
        );
    }

    /**
     * @param string $jobHandle
     * @return array
     */
    public function jobStatus($jobHandle)
    {
        return $this->gearmanClient->jobStatus($jobHandle);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTask($functionName, WorkloadInterface $workload = null, $context = null, $uniqueId = null)
    {
        return $this->gearmanClient->addTask(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $context,
            $uniqueId
        );
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskHigh($functionName, WorkloadInterface $workload = null, $context = null, $uniqueId = null)
    {
        return $this->gearmanClient->addTaskHigh(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $context,
            $uniqueId
        );
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskLow($functionName, WorkloadInterface $workload = null, $context = null, $uniqueId = null)
    {
        return $this->gearmanClient->addTaskLow(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $context,
            $uniqueId
        );
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskBackground(
        $functionName,
        WorkloadInterface $workload = null,
        $context = null,
        $uniqueId = null
    ) {
        return $this->gearmanClient->addTaskBackground(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $context,
            $uniqueId
        );
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskHighBackground(
        $functionName,
        WorkloadInterface $workload = null,
        $context = null,
        $uniqueId = null
    ) {
        return $this->gearmanClient->addTaskHighBackground(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $context,
            $uniqueId
        );
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskLowBackground(
        $functionName,
        WorkloadInterface $workload = null,
        $context = null,
        $uniqueId = null
    ) {
        return $this->gearmanClient->addTaskLowBackground(
            $functionName,
            $this->getWorkloadEncodedData($workload),
            $context,
            $uniqueId
        );
    }

    /**
     * @param string $jobHandle
     * @param string|null $context
     * @return mixed
     */
    public function addTaskStatus($jobHandle, $context = null)
    {
        return $this->gearmanClient->addTaskStatus($jobHandle, $context);
    }

    /**
     * @param callback $callback
     * @return mixed
     */
    public function setWorkloadCallback($callback)
    {
        return $this->gearmanClient->setWorkloadCallback($callback);
    }

    /**
     * @param callback $callback
     * @return mixed
     */
    public function setCreatedCallback($callback)
    {
        return $this->gearmanClient->setCreatedCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setDataCallback($callback)
    {
        return $this->gearmanClient->setDataCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setWarningCallback($callback)
    {
        return $this->gearmanClient->setWarningCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setStatusCallback($callback)
    {
        return $this->gearmanClient->setStatusCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setCompleteCallback($callback)
    {
        return $this->gearmanClient->setCompleteCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setExceptionCallback($callback)
    {
        return $this->gearmanClient->setExceptionCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setFailCallback($callback)
    {
        return $this->gearmanClient->setFailCallback($callback);
    }

    /**
     * @return bool
     */
    public function clearCallbacks()
    {
        return $this->gearmanClient->clearCallbacks();
    }

    /**
     * @return bool
     */
    public function runTasks()
    {
        return $this->gearmanClient->runTasks();
    }

    /**
     * @param WorkloadInterface $workload
     * @return string
     */
    protected function getWorkloadEncodedData(WorkloadInterface $workload = null)
    {
        if (!$workload instanceof WorkloadInterface || !$workload->getEncodedData()) {
            return 0;
        }

        return $workload->getEncodedData();
    }
}
