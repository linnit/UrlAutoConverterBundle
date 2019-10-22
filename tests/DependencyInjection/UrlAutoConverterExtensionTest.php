<?php

namespace Linnit\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Linnit\DependencyInjection\UrlAutoConverterExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UrlAutoConverterExtensionTest extends TestCase
{
    private $configuration;

    public function testLoadDefaults()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new UrlAutoConverterExtension();
        $loader->load(array(), $this->configuration);

        $this->assertParameter('', 'linnit_url_auto_converter.linkclass');
        $this->assertParameter('_blank', 'linnit_url_auto_converter.target');
        $this->assertParameter(false, 'linnit_url_auto_converter.debugmode');
        $this->assertHasDefinition('linnit_url_auto_converter.twig.extension');
    }

    public function testTargetCustom()
    {
        $this->configuration = new ContainerBuilder();
        $loader = new UrlAutoConverterExtension();
        $loader->load(array(array('linkclass' => 'foo', 'target' => 'bar', 'debugmode' => true)), $this->configuration);

        $this->assertParameter('foo', 'linnit_url_auto_converter.linkclass');
        $this->assertParameter('bar', 'linnit_url_auto_converter.target');
        $this->assertParameter(true, 'linnit_url_auto_converter.debugmode');
        $this->assertHasDefinition('linnit_url_auto_converter.twig.extension');
    }

    private function assertAlias($value, $key)
    {
        $this->assertEquals($value, (string) $this->configuration->getAlias($key), sprintf('%s alias is incorrect', $key));
    }

    private function assertParameter($value, $key)
    {
        $this->assertEquals($value, $this->configuration->getParameter($key), sprintf('%s parameter is incorrect', $key));
    }

    private function assertHasDefinition($id)
    {
        $this->assertTrue(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    private function assertNotHasDefinition($id)
    {
        $this->assertFalse(($this->configuration->hasDefinition($id) ?: $this->configuration->hasAlias($id)));
    }

    protected function tearDown(): void
    {
        unset($this->configuration);
    }
}
