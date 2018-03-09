<?php

namespace C0ntax\EnvProvidersBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class C0ntaxEnvProvidersExtension
 *
 * @package C0ntax\EnvProvidersBundle\DependencyInjection
 */
class C0ntaxEnvProvidersExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('c0ntax_env_providers.array', $config['array']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../../resources/config'));
        $loader->load('services.yaml');
    }
}
