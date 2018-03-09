<?php
declare(strict_types = 1);

namespace C0ntax\EnvProvidersBundle;

use Symfony\Component\DependencyInjection\EnvVarProcessorInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * Class ArrayEnvVarProcessor
 *
 * @package C0ntax\EnvProvidersBundle
 */
class ArrayEnvVarProcessor implements EnvVarProcessorInterface
{
    /** @var array */
    private $config;

    /**
     * ArrayEnvVarProcessor constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->setConfig($config);
    }

    /**
     * @param string   $prefix
     * @param string   $name
     * @param \Closure $getEnv
     * @return array
     * @throws RuntimeException
     */
    public function getEnv($prefix, $name, \Closure $getEnv): ?array
    {
        if ('array' === $prefix) {
            $env = $getEnv($name);
            if ($env === null || $env === '') {
                if ($this->getConfig()['return_null_if_empty']) {
                    return null;
                } else {
                    return [];
                }
            }

            return preg_split('/\s*,\s*/', $env);
        }

        throw new RuntimeException(sprintf('Unsupported env var prefix "%s".', $prefix));
    }

    /**
     * @return array
     */
    public static function getProvidedTypes(): array
    {
        return [
            'array' => 'array',
        ];
    }

    /**
     * @return array
     */
    private function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return ArrayEnvVarProcessor
     */
    private function setConfig(array $config): ArrayEnvVarProcessor
    {
        $this->config = $config;

        return $this;
    }
}
