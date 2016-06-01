<?php

namespace Horrible\GearmanBundle\Tests\Unit\Worker;

use GearmanWorker;
use Horrible\GearmanBundle\Configurator\GearmanConfigurator;
use Horrible\GearmanBundle\Job\JobsManager;
use Horrible\GearmanBundle\Tests\Base\BaseTest;
use Horrible\GearmanBundle\Worker\Worker;

class WorkerTest extends BaseTest
{
    public function testWork()
    {
        $gearmanWorkerMock = $this->getClassMock(
            GearmanWorker::class,
            [
                'work',
            ]
        );
        $gearmanWorkerMock->expects($this->at(0))
            ->method('work')
            ->will(
                $this->returnValue(true)
            );
        $gearmanWorkerMock->expects($this->at(1))
            ->method('work')
            ->will(
                $this->returnValue(false)
            );

        $jobsManagerMock = $this->getClassMock(
            JobsManager::class,
            [
                'registerJobs',
                'setWorkerId',
            ]
        );
        $jobsManagerMock->expects($this->once())
            ->method('registerJobs')
            ->with($this->isInstanceOf(GearmanWorker::class));
        $jobsManagerMock->expects($this->once())
            ->method('setWorkerId')
            ->with($this->isType('string'));

        $gearmanConfiguratorMock = $this->getClassMock(
            GearmanConfigurator::class,
            [
                'configure',
            ]
        );
        $gearmanConfiguratorMock->expects($this->once())
            ->method('configure')
            ->with($this->isInstanceOf(GearmanWorker::class));

        $worker = new Worker(
            $gearmanWorkerMock,
            $jobsManagerMock,
            $gearmanConfiguratorMock
        );

        $result = $worker->work();
        $this->assertNull($result);
    }
}
