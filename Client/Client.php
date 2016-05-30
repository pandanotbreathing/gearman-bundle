<?php

namespace Horrible\GearmanBundle\Client;

use Horrible\GearmanBundle\Configurator\GearmanConfigurator;
use Horrible\GearmanBundle\Workload\WorkloadInterface;

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
    public function __construct(\GearmanClient $gearmanClient, GearmanConfigurator $configurator)
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
    public function doHigh($functionName, WorkloadInterface $workload, $uniqueId = null)
    {
        return $this->gearmanClient->doHigh($functionName, $workload->getEncodedData(), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doNormal($functionName, WorkloadInterface $workload, $uniqueId = null)
    {
        return $this->gearmanClient->doNormal($functionName, $workload->getEncodedData(), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doLow($functionName, WorkloadInterface $workload, $uniqueId = null)
    {
        return $this->gearmanClient->doLow($functionName, $workload->getEncodedData(), $uniqueId);
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
    public function doBackground($functionName, WorkloadInterface $workload, $uniqueId = null)
    {
        return $this->gearmanClient->doBackground($functionName, $workload->getEncodedData(), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doHighBackground($functionName, WorkloadInterface $workload, $uniqueId = null)
    {
        return $this->gearmanClient->doHighBackground($functionName, $workload->getEncodedData(), $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $uniqueId
     * @return string
     */
    public function doLowBackground($functionName, WorkloadInterface $workload, $uniqueId = null)
    {
        return $this->gearmanClient->doLowBackground($functionName, $workload->getEncodedData(), $uniqueId);
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
    public function addTask($functionName, WorkloadInterface $workload, $context = null, $uniqueId = null)
    {
        return $this->addTask($functionName, $workload->getEncodedData(), $context, $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskHigh($functionName, WorkloadInterface $workload, $context = null, $uniqueId = null)
    {
        return $this->addTaskHigh($functionName, $workload->getEncodedData(), $context, $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskLow($functionName, WorkloadInterface $workload, $context = null, $uniqueId = null)
    {
        return $this->addTaskLow($functionName, $workload->getEncodedData(), $context, $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskBackground($functionName, WorkloadInterface $workload, $context = null, $uniqueId = null)
    {
        return $this->addTaskBackground($functionName, $workload->getEncodedData(), $context, $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskHighBackground($functionName, WorkloadInterface $workload, $context = null, $uniqueId = null)
    {
        return $this->addTaskHighBackground($functionName, $workload->getEncodedData(), $context, $uniqueId);
    }

    /**
     * @param string $functionName
     * @param WorkloadInterface $workload
     * @param string|null $context
     * @param string|null $uniqueId
     * @return mixed
     */
    public function addTaskLowBackground($functionName, WorkloadInterface $workload, $context = null, $uniqueId = null)
    {
        return $this->addTaskLowBackground($functionName, $workload->getEncodedData(), $context, $uniqueId);
    }

    /**
     * @param string $jobHandle
     * @param string|null $context
     * @return mixed
     */
    public function addTaskStatus($jobHandle, $context = null)
    {
        return $this->addTaskStatus($jobHandle, $context);
    }

    /**
     * @param callback $callback
     * @return mixed
     */
    public function setWorkloadCallback($callback)
    {
        return $this->setWorkloadCallback($callback);
    }

    /**
     * @param callback $callback
     * @return mixed
     */
    public function setCreatedCallback($callback)
    {
        return $this->setCreatedCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setDataCallback($callback)
    {
        return $this->setDataCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setWarningCallback($callback)
    {
        return $this->setWarningCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setStatusCallback($callback)
    {
        return $this->setStatusCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setCompleteCallback($callback)
    {
        return $this->setCompleteCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setExceptionCallback($callback)
    {
        return $this->setExceptionCallback($callback);
    }

    /**
     * @param callback $callback
     * @return bool
     */
    public function setFailCallback($callback)
    {
        return $this->setFailCallback($callback);
    }

    /**
     * @return bool
     */
    public function clearCallbacks()
    {
        return $this->clearCallbacks();
    }

    /**
     * @return bool
     */
    public function runTasks()
    {
        return $this->runTasks();
    }
}
