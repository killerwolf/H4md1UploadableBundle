<?php

namespace H4md1\UploadableBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use H4md1\UploadableBundle\DependencyInjection\Compiler\MappingsPass;

class H4md1UploadableBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MappingsPass());
    }
}
