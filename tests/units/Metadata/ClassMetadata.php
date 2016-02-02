<?php

namespace Novaway\Component\OpenGraph\tests\units\Metadata;

use atoum;
use Novaway\Component\OpenGraph\Annotation\NamespaceNode;

class ClassMetadata extends atoum
{
    public function testAddGraphMetadata()
    {
        $this
            ->if($this->newTestedInstance('BlogPost'))
            ->then
                ->array($this->testedInstance->namespaces)
                    ->isEmpty()
                ->array($this->testedInstance->nodes)
                    ->isEmpty()

            ->given(
                $namespace = new NamespaceNode(['prefix' => 'og', 'uri' => 'http://ogp.me/ns#']),
                $graphNode = new \mock\Novaway\Component\OpenGraph\Annotation\GraphNode('foo', 'bar'),
                $graphMetadata = new \mock\Novaway\Component\OpenGraph\Metadata\GraphMetadataInterface(),
                $this->testedInstance->addGraphNamespace($namespace),
                $this->testedInstance->addGraphMetadata($graphNode, $graphMetadata)
            )
            ->then
                ->array($this->testedInstance->namespaces)
                    ->object[0]->isEqualTo($namespace)
                    ->hasSize(1)
                ->array($this->testedInstance->nodes)
                    ->array[0]->isEqualTo(['node' => $graphNode, 'object' => $graphMetadata])
                    ->hasSize(1)

            ->given(
                $namespace2 = new NamespaceNode(['prefix' => 'custom', 'uri' => 'http://uri/ns#']),
                $graphNode2 = new \mock\Novaway\Component\OpenGraph\Annotation\GraphNode('john', 'doe'),
                $graphMetadata2 = new \mock\Novaway\Component\OpenGraph\Metadata\GraphMetadataInterface(),
                $this->testedInstance->addGraphNamespace($namespace2),
                $this->testedInstance->addGraphMetadata($graphNode2, $graphMetadata2)
            )
                ->array($this->testedInstance->namespaces)
                    ->object[0]->isEqualTo($namespace)
                    ->object[1]->isEqualTo($namespace2)
                    ->hasSize(2)
                ->array($this->testedInstance->nodes)
                    ->array[0]->isEqualTo(['node' => $graphNode, 'object' => $graphMetadata])
                    ->array[1]->isEqualTo(['node' => $graphNode2, 'object' => $graphMetadata2])
                    ->hasSize(2)
        ;
    }
}
