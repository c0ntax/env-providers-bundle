<?php

namespace C0ntax\EnvProvidersBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package C0ntax\EnvProvidersBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     * @throws \RuntimeException
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('c0ntax_env_providers');

        // @formatter:off
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('array')
                ->addDefaultsIfNotSet()
                ->children()
                    ->booleanNode('return_null_if_empty')->defaultTrue()->info('If the ENV is blank, return a null instead of an empty array')->end()
                    ->end()
                ->end()
            ->end()
        ;

        // @formatter:on

        return $treeBuilder;
    }

}
