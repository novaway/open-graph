<?php

namespace Novaway\Component\OpenGraph\Tests\Units;

use atoum;
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
                $metadata = $this->createMetadata('stdClass', [
                    ['namespace' => 'foo', 'tag' => 'bar', 'value' => 'content'],
                ]),
                $metadataFactory = $this->createMetadataFactory($metadata)
            )
            ->if($this->newTestedInstance($metadataFactory))
            ->then
                ->object($graph = $this->testedInstance->generate($object))
                    ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraph')
                ->array($graph->getTags())
                    ->object[0]
                        ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTag')
                        ->isEqualTo(new OpenGraphTag('foo', 'bar', 'content'))
                    ->hasSize(1)


            ->given(
                $metadata = $this->createMetadata('stdClass', [
                    ['namespace' => 'foo', 'tag' => 'bar', 'value' => 'content'],
                    ['namespace' => 'john', 'tag' => 'doe', 'value' => 'actor'],
                ]),
                $metadataFactory = $this->createMetadataFactory($metadata)
            )
            ->if($this->newTestedInstance($metadataFactory))
            ->then
                ->object($graph = $this->testedInstance->generate($object))
                    ->isInstanceOf('Novaway\Component\OpenGraph\OpenGraph')
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

    private function createMetadata($class, array $properties = [])
    {
        $metadata = new \mock\Novaway\Component\OpenGraph\Metadata\ClassMetadata($class);

        foreach ($properties as $prop) {
            $graphNode = new \mock\Novaway\Component\OpenGraph\Annotation\GraphNode($prop['namespace'], $prop['tag']);

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


