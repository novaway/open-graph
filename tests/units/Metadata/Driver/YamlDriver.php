<?php

namespace Novaway\Component\OpenGraph\Tests\Units\Metadata\Driver;

use Metadata\Driver\FileLocator;
use Novaway\Component\OpenGraph\Annotation\NamespaceNode;
use Novaway\Component\OpenGraph\Metadata\MethodMetadata;
use Novaway\Component\OpenGraph\Metadata\PropertyMetadata;

class YamlDriver extends AbstractDriver
{
    public function testLoadMetadataForClass()
    {
        $this
            ->given(
                $class = new \ReflectionClass('BlogPost'),
                $locator = new FileLocator(['' => __DIR__.'/../../../fixtures/config'])
            )
            ->if($this->newTestedInstance($locator))
            ->then
                ->given($metadata = $this->testedInstance->loadMetadataForClass($class))
                ->object($metadata)
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\ClassMetadata')
                ->array($metadata->namespaces)
                    ->contains(new NamespaceNode(['prefix' => 'og', 'uri' => 'http://ogp.me/ns#']))
                    ->contains(new NamespaceNode(['prefix' => 'foo', 'uri' => 'bar']))
                    ->hasSize(2)
                ->array($metadata->nodes)
                    ->contains(['node' => $this->createCustomNode('og', 'title'), 'object' => new PropertyMetadata('BlogPost', 'title')])
                    ->contains(['node' => $this->createCustomNode('foo', 'node'), 'object' => new PropertyMetadata('BlogPost', 'title')])
                    ->contains(['node' => $this->createCustomNode('foo', 'bar'), 'object' => new MethodMetadata('BlogPost', 'getUrl')])
                    ->hasSize(3)
        ;
    }

    public function testLoadMetadataForApplicationClass()
    {
        $this
            ->given(
                $class = new \ReflectionClass('Software\Application'),
                $locator = new FileLocator(['Software' => __DIR__.'/../../../fixtures/config'])
            )
            ->if($this->newTestedInstance($locator))
            ->then
                ->given($metadata = $this->testedInstance->loadMetadataForClass($class))
                ->object($metadata)
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\ClassMetadata')
                ->array($metadata->namespaces)
                    ->isEmpty()
                ->array($metadata->nodes)
                    ->contains(['node' => $this->createCustomNode('twitter', 'app:creator'), 'object' => new MethodMetadata('Software\Application', 'getCreator')])
                    ->hasSize(1)
        ;
    }
}
