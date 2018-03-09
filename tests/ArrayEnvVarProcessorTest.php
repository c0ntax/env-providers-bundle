<?php

namespace C0ntax\EnvProvidersBundle;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArrayEnvVarProcessorTest extends KernelTestCase
{
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        parent::setUp();
        static::bootKernel();
    }

    /**
     * @dataProvider createGetEnvTestCases
     * @param string     $param
     * @param array|null $expected
     */
    public function testGetEnvFramework(string $param, ?array $expected)
    {
        self::assertEquals($expected, static::$kernel->getContainer()->getParameter($param));
    }

    public function testGetProvidedTypes()
    {
        self::assertEquals(['array' => 'array'], ArrayEnvVarProcessor::getProvidedTypes());
    }

    public function createGetEnvTestCases()
    {
        return [
            'one item' => [
                'param' => 'array1',
                'expected' => ['one item'],
            ],
            'multiple items' => [
                'param' => 'array2',
                'expected' => ['two', 'items'],
            ],
            'no items' => [
                'param' => 'array3',
                'expected' => null,
            ]
        ];
    }
}
