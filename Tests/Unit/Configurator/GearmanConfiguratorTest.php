<?php

namespace Horrible\GearmanBundle\Tests\Unit\Configurator;

use Horrible\GearmanBundle\Configurator\GearmanConfigurator;
use Horrible\GearmanBundle\Tests\Base\BaseTest;
use GearmanClient;

class GearmanConfiguratorTest extends BaseTest
{

    /**
     * @param array $servers
     *
     * @dataProvider configureDataProvider
     */
    public function testConfigure(array $servers)
    {
        $gearmanClient = $this->getClassMock(
            GearmanClient::class,
            [
                'addServer',
            ]
        );
        $gearmanClient->expects($this->at(0))
            ->method('addServer')
            ->with(
                $servers[0]['host'],
                $servers[0]['port']
            );

        $gearmanConfigurator = new GearmanConfigurator($servers);
        $this->assertInstanceOf(GearmanClient::class, $gearmanConfigurator->configure($gearmanClient));
    }

    /**
     * @return array
     */
    public function configureDataProvider()
    {
        $servers = [
            [
                'host' => '127.0.0.1',
                'port' => '123',
            ],
        ];

        return [
            [
                $servers,
            ],
        ];
    }
}
