<?php

namespace Horrible\GearmanBundle\DependencyInjection;

use Horrible\GearmanBundle\Job\JobInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class HorribleCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $builder)
    {
        if (!$builder->has('horrible.gearman.jobs.manager')) {
            return;
        }

        $definition = $builder->findDefinition('horrible.gearman.jobs.manager');
        $this->fillJobList($builder, $definition);
    }

    /**
     * @param ContainerBuilder $builder
     * @param Definition $definition
     */
    protected function fillJobList(ContainerBuilder $builder, Definition $definition)
    {
        $jobServices = $builder->findTaggedServiceIds(JobInterface::TAG_NAME);

        foreach ($jobServices as $jobServiceId => $tags) {
            $definition->addMethodCall(
                'addJob',
                [
                    new Reference($jobServiceId),
                ]
            );
        }
    }
}
