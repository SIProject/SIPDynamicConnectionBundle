<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\DynamicConnectionBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sip_dynamic_connection');

        $rootNode
            ->children()
                ->scalarNode('app_kernel_path')->defaultValue('/AppKernelDynamic.php')->end()
                ->scalarNode('config_path')->defaultValue('/config/resources/dynamic.yml')->end()
                ->scalarNode('routing_path')->defaultValue('/config/routing_dynamic.yml')->end()
            ->end();

        return $treeBuilder;
    }
}