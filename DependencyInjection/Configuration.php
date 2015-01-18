<?php

namespace H4md1\UploadableBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('h4md1_uploadable');

        $this->addMappingSection($rootNode);

        $rootNode
            ->children()
            ->end()
        ;

        return $treeBuilder;
    }
    private function addMappingSection(ArrayNodeDefinition $node)
    {
        $node
            ->fixXmlConfig('mapping')
            ->children()
                ->arrayNode('mappings')
                ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('entity')->isRequired()->end()
                        ->scalarNode('filesystem')->isRequired()->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
