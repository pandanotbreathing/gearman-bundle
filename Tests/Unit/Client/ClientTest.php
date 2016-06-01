<?php

namespace Horrible\GearmanBundle\Tests\Unit\Client;

use GearmanClient;
use Horrible\GearmanBundle\Client\Client;
use Horrible\GearmanBundle\Configurator\GearmanConfigurator;
use Horrible\GearmanBundle\Tests\Base\BaseTest;
use Horrible\GearmanBundle\Workload\SimpleWorkload;
use Horrible\GearmanBundle\Workload\WorkloadInterface;

class ClientTest extends BaseTest
{
    /**
     * @param WorkloadInterface $workload
     *
     * @dataProvider doHighDataProvider
     */
    public function testDoHigh($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doHigh',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doHigh')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->doHigh($methodName, $workload));
    }

    /**
     * @return array
     */
    public function doHighDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'doHigh';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param WorkloadInterface $workload
     *
     * @dataProvider doNormalDataProvider
     */
    public function testDoNormal($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doNormal',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doNormal')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->doNormal($methodName, $workload));
    }

    /**
     * @return array
     */
    public function doNormalDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'doNormal';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param WorkloadInterface $workload
     *
     * @dataProvider doLowDataProvider
     */
    public function testDoLow($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doLow',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doLow')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->doLow($methodName, $workload));
    }

    /**
     * @return array
     */
    public function doLowDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'doLow';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    public function testDoJobHandle()
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doJobHandle',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doJobHandle');

        $client = $this->getGearmanClient($gearmanClientMock);
        $result = $client->doJobHandle();
        $this->assertNull($result);
    }

    public function testDoStatus()
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doStatus',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doStatus');

        $client = $this->getGearmanClient($gearmanClientMock);
        $result = $client->doStatus();
        $this->assertNull($result);
    }

    /**
     * @param WorkloadInterface $workload
     *
     * @dataProvider doBackgroundDataProvider
     */
    public function testDoBackground($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doBackground',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doBackground')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->doBackground($methodName, $workload));
    }

    /**
     * @return array
     */
    public function doBackgroundDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'doBackground';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param WorkloadInterface $workload
     *
     * @dataProvider doHighBackgroundDataProvider
     */
    public function testDoHighBackground($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doHighBackground',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doHighBackground')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->doHighBackground($methodName, $workload));
    }

    /**
     * @return array
     */
    public function doHighBackgroundDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'doHighBackground';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param WorkloadInterface $workload
     *
     * @dataProvider doLowBackgroundDataProvider
     */
    public function testDoLowBackground($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'doLowBackground',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('doLowBackground')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->doLowBackground($methodName, $workload));
    }

    /**
     * @return array
     */
    public function doLowBackgroundDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'doLowBackground';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $jobHandle
     * @param string $jobStatus
     *
     * @dataProvider jobStatusDataProvider
     */
    public function testJobStatus($jobHandle, $jobStatus)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'jobStatus',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('jobStatus')
            ->with($jobHandle)
            ->will(
                $this->returnValue($jobStatus)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $result = $client->jobStatus($jobHandle);
        $this->assertEquals($result, $jobStatus);
    }

    /**
     * @return array
     */
    public function jobStatusDataProvider()
    {
        $jobHandle = 'handleJob';
        $jobStatus = 'success';

        return [
            [
                $jobHandle,
                $jobStatus,
            ],
        ];
    }

    /**
     * @param string $methodName
     * @param WorkloadInterface $workload
     * @param string $result
     *
     * @dataProvider addTaskDataProvider
     */
    public function testAddTask($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTask',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTask')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null,
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->addTask($methodName, $workload));
    }

    /**
     * @return array
     */
    public function addTaskDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'addTask';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $methodName
     * @param WorkloadInterface $workload
     * @param string $result
     *
     * @dataProvider addTaskHighDataProvider
     */
    public function testaddTaskHigh($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTaskHigh',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTaskHigh')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null,
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->addTaskHigh($methodName, $workload));
    }

    /**
     * @return array
     */
    public function addTaskHighDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'addTaskHigh';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $methodName
     * @param WorkloadInterface $workload
     * @param string $result
     *
     * @dataProvider addTaskLowDataProvider
     */
    public function testaddTaskLow($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTaskLow',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTaskLow')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null,
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->addTaskLow($methodName, $workload));
    }

    /**
     * @return array
     */
    public function addTaskLowDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'addTaskLow';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $methodName
     * @param WorkloadInterface $workload
     * @param string $result
     *
     * @dataProvider addTaskBackgroundDataProvider
     */
    public function testaddTaskBackground($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTaskBackground',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTaskBackground')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null,
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->addTaskBackground($methodName, $workload));
    }

    /**
     * @return array
     */
    public function addTaskBackgroundDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'addTaskBackground';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $methodName
     * @param WorkloadInterface $workload
     * @param string $result
     *
     * @dataProvider addTaskHighBackgroundDataProvider
     */
    public function testaddTaskHighBackground($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTaskHighBackground',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTaskHighBackground')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null,
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->addTaskHighBackground($methodName, $workload));
    }

    /**
     * @return array
     */
    public function addTaskHighBackgroundDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'addTaskHighBackground';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $methodName
     * @param WorkloadInterface $workload
     * @param string $result
     *
     * @dataProvider addTaskLowBackgroundDataProvider
     */
    public function testaddTaskLowBackground($methodName, WorkloadInterface $workload, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTaskLowBackground',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTaskLowBackground')
            ->with(
                $methodName,
                $workload->getEncodedData(),
                null,
                null
            )
            ->will(
                $this->returnValue($result)
            );

        $gearmanClient = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $gearmanClient->addTaskLowBackground($methodName, $workload));
    }

    /**
     * @return array
     */
    public function addTaskLowBackgroundDataProvider()
    {
        $workload = new SimpleWorkload();
        $workload->setEncodedData('my test data');

        $methodName = 'addTaskLowBackground';

        $result = 'successResult';

        return [
            [
                $methodName,
                $workload,
                $result,
            ],
        ];
    }

    /**
     * @param string $jobHandle
     * @param string $jobResult
     *
     * @dataProvider addTaskStatusDataProvider
     */
    public function testAddTaskStatus($jobHandle, $jobResult)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'addTaskStatus',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('addTaskStatus')
            ->with(
                $jobHandle,
                null
            )
            ->will(
                $this->returnValue($jobResult)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $result = $client->addTaskStatus($jobHandle);
        $this->assertEquals($result, $jobResult);
    }

    /**
     * @return array
     */
    public function addTaskStatusDataProvider()
    {
        $jobHandle = 'job to handle';
        $jobResult = 'success';

        return [
            [
                $jobHandle,
                $jobResult,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setWorkloadCallbackDataProvider
     */
    public function testSetWorkloadCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setWorkloadCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setWorkloadCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setWorkloadCallback($callback));
    }

    /**
     * @return array
     */
    public function setWorkloadCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setCreatedCallbackDataProvider
     */
    public function testSetCreatedCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setCreatedCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setCreatedCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setCreatedCallback($callback));
    }

    /**
     * @return array
     */
    public function setCreatedCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setDataCallbackDataProvider
     */
    public function testSetDataCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setDataCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setDataCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setDataCallback($callback));
    }

    /**
     * @return array
     */
    public function setDataCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setWarningCallbackDataProvider
     */
    public function testSetWarningCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setWarningCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setWarningCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setWarningCallback($callback));
    }

    /**
     * @return array
     */
    public function setWarningCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setStatusCallbackDataProvider
     */
    public function testSetStatusCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setStatusCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setStatusCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setStatusCallback($callback));
    }

    /**
     * @return array
     */
    public function setStatusCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setCompleteCallbackDataProvider
     */
    public function testSetCompleteCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setCompleteCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setCompleteCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setCompleteCallback($callback));
    }

    /**
     * @return array
     */
    public function setCompleteCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setExceptionCallbackDataProvider
     */
    public function testSetExceptionCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setExceptionCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setExceptionCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setExceptionCallback($callback));
    }

    /**
     * @return array
     */
    public function setExceptionCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param callback $callback
     * @param string $result
     *
     * @dataProvider setFailCallbackDataProvider
     */
    public function testSetFailCallback($callback, $result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'setFailCallback',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('setFailCallback')
            ->with($callback)
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->setFailCallback($callback));
    }

    /**
     * @return array
     */
    public function setFailCallbackDataProvider()
    {
        $callback = function () {
            //SomeTestStuff
        };

        $result = 'some result';

        return [
            [
                $callback,
                $result,
            ],
        ];
    }

    /**
     * @param string $result
     *
     * @dataProvider clearCallbacksDataProvider
     */
    public function testClearCallbacks($result)
    {
        $gearmanClientMock = $this->getClassMock(
            GearmanClient::class,
            [
                'clearCallbacks',
            ]
        );
        $gearmanClientMock->expects($this->once())
            ->method('clearCallbacks')
            ->will(
                $this->returnValue($result)
            );

        $client = $this->getGearmanClient($gearmanClientMock);
        $this->assertEquals($result, $client->clearCallbacks());
    }

    /**
     * @return array
     */
    public function clearCallbacksDataProvider()
    {
        $result = 'some result';

        return [
            [
                $result,
            ],
        ];
    }

    /**
     * @param GearmanClient $gearmanClient
     * @return Client
     */
    protected function getGearmanClient(GearmanClient $gearmanClient)
    {
        $gearmanConfigurator = $this->getClassMock(
            GearmanConfigurator::class,
            [
                'configure',
            ]
        );
        $gearmanConfigurator->expects($this->once())
            ->method('configure')
            ->with($this->isInstanceOf(GearmanClient::class));

        return new Client(
            $gearmanClient,
            $gearmanConfigurator
        );
    }
}
