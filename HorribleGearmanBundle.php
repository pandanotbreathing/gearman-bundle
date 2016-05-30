<?php

namespace Horrible\GearmanBundle;

use Horrible\GearmanBundle\DependencyInjection\HorribleCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class HorribleGearmanBundle
 * @package Horrible\GearmanBundle
 */
class HorribleGearmanBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new HorribleCompilerPass());
        $container->addCompilerPass(
            new RegisterListenersPass(
                'horrible.event_dispatcher',
                'horrible.event_listener',
                'horrible.event_subscriber'
            ),
            PassConfig::TYPE_BEFORE_REMOVING
        );
    }
}
