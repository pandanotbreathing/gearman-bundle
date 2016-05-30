<?php

namespace Horrible\GearmanBundle\Configurator;

/**
 * Class GearmanConfigurator
 * @package Horrible\GearmanBundle\Configurator
 */
class GearmanConfigurator
{
    /**
     * @var array
     */
    protected $servers = [];

    /**
     * @param array $servers
     */
    public function __construct(array $servers = [])
    {
        $this->setServers($servers);
    }

    /**
     * @param array $servers
     */
    public function setServers(array $servers = [])
    {
        $this->servers = $servers;
    }

    /**
     * @param object $instance
     * @return object
     */
    public function configure($instance)
    {
        $this->addServers($instance);

        return $instance;
    }

    /**
     * @param object $instance
     */
    protected function addServers($instance)
    {
        if (empty($this->servers)) {
            $instance->addServer();
            return;
        }

        foreach ($this->servers as $server) {
            if (!isset($server['host'])) {
                continue;
            }

            if (isset($server['port'])) {
                $instance->addServer($server['host'], $server['port']);
                continue;
            }

            $instance->addServer($server['host']);
        }
    }
}
