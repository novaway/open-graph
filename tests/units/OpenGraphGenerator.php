<?php

namespace Novaway\Component\OpenGraph\tests\units;

use atoum;
use Novaway\Component\OpenGraph\Annotation\NamespaceNode;
use Novaway\Component\OpenGraph\OpenGraphTag;

class OpenGraphGenerator extends atoum
{
    public function testGenerate()
    {
        $this
            ->given(
                $object = new \mock\stdClass(),
                $metadata = $this->createMetadata('stdClass'),
                $metadataFactory = $this->createMetadataFactory($metadata)
            )
            ->if($this->newTestedInstance($metadataFactory))
            ->then
                ->object($this->testedInstance->generate($object))
                    ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraph')

            ->given(
                $namespaces = [
                    'og' => 'http://ogp.me/ns#',
                ],
                $properties = [
                    ['namespace' => 'foo', 'tag' => 'bar', 'value' => 'content'],
                ],
                $metadata = $this->createMetadata('stdClass', $properties, $namespaces),
                $metadataFactory = $this->createMetadataFactory($metadata)
            )
            ->if($this->newTestedInstance($metadataFactory))
            ->then
                ->object($graph = $this->testedInstance->generate($object))
                    ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraph')
                ->array($graph->getNamespaces())
                    ->string['og']->isEqualTo('http://ogp.me/ns#')
                    ->hasSize(1)
                ->array($graph->getTags())
                    ->object[0]
                        ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTag')
                        ->isEqualTo(new OpenGraphTag('foo', 'bar', 'content'))
                    ->hasSize(1)


            ->given(
                $namespaces = [
                    'og' => 'http://ogp.me/ns#',
                    'custom' => 'http://uri',
                ],
                $properties = [
                    ['namespace' => 'foo', 'tag' => 'bar', 'value' => 'content'],
                    ['namespace' => 'john', 'tag' => 'doe', 'value' => 'actor'],
                ],
                $metadata = $this->createMetadata('stdClass', $properties, $namespaces),
                $metadataFactory = $this->createMetadataFactory($metadata)
            )
            ->if($this->newTestedInstance($metadataFactory))
            ->then
                ->object($graph = $this->testedInstance->generate($object))
                    ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraph')
                ->array($graph->getNamespaces())
                    ->string['og']->isEqualTo('http://ogp.me/ns#')
                    ->string['custom']->isEqualTo('http://uri')
                    ->hasSize(2)
                ->array($graph->getTags())
                    ->object[0]
                        ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTag')
                        ->isEqualTo(new OpenGraphTag('foo', 'bar', 'content'))
                    ->object[1]
                        ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTag')
                        ->isEqualTo(new OpenGraphTag('john', 'doe', 'actor'))
                    ->hasSize(2)

            ->given(
                $properties = [
                    ['namespace' => 'foo', 'uri' => 'http://uri-foo#', 'tag' => 'bar', 'value' => 'content'],
                    ['namespace' => 'john', 'uri' => 'http://uri-jonh#', 'tag' => 'doe', 'value' => 'actor'],
                ],
                $metadata = $this->createMetadata('stdClass', $properties),
                $metadataFactory = $this->createMetadataFactory($metadata)
            )
            ->if($this->newTestedInstance($metadataFactory))
            ->then
                ->object($graph = $this->testedInstance->generate($object))
                    ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraph')
                ->array($graph->getNamespaces())
                    ->string['foo']->isEqualTo('http://uri-foo#')
                    ->string['john']->isEqualTo('http://uri-jonh#')
                    ->hasSize(2)
                ->array($graph->getTags())
                    ->object[0]
                        ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTag')
                        ->isEqualTo(new OpenGraphTag('foo', 'bar', 'content'))
                    ->object[1]
                        ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTag')
                        ->isEqualTo(new OpenGraphTag('john', 'doe', 'actor'))
                        ->hasSize(2)
        ;
    }

    private function createMetadata($class, array $properties = [], array $namespaces = [])
    {
        $metadata = new \mock\Novaway\Component\OpenGraph\Metadata\ClassMetadata($class);

        foreach ($namespaces as $prefix => $uri) {
            $node = new NamespaceNode(['prefix' => $prefix, 'uri' => $uri]);
            $metadata->addGraphNamespace($node);
        }

        foreach ($properties as $prop) {
            $values = [];
            if (isset($prop['uri'])) {
                $values['namespaceUri'] = $prop['uri'];
            }

            $graphNode = new \mock\Novaway\Component\OpenGraph\Annotation\GraphNode($prop['namespace'], $prop['tag'], $values);

            $property = new \mock\Novaway\Component\OpenGraph\Metadata\GraphMetadataInterface();
            $property->getMockController()->getValue = function() use ($prop) {
                return $prop['value'];
            };

            $metadata->addGraphMetadata($graphNode, $property);
        }

        return $metadata;
    }

    private function createMetadataFactory($metadata)
    {
        $metadataFactory = new \mock\Metadata\MetadataFactoryInterface();
        $metadataFactory->getMockController()->getMetadataForClass = function() use ($metadata) {
            return $metadata;
        };

        return $metadataFactory;
    }
}


