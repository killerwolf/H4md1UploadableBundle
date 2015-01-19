<?php

namespace H4md1\UploadableBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MappingsPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if($container->hasDefinition('h4md1_app.upload_manager')) {
            $container->getDefinition('h4md1_app.upload_manager')->addMethodCall('setMappings',[$container->getParameter('h4md1_uploadable.mappings')]);
        }
    }
}
