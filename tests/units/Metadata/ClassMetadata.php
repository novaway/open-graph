<?php

namespace Novaway\Component\OpenGraph\tests\units\Metadata;

use atoum;

class ClassMetadata extends atoum
{
    public function testAddGraphMetadata()
    {
        $this
            ->if($this->newTestedInstance('BlogPost'))
            ->then
                ->array($this->testedInstance->nodes)
                    ->isEmpty()

            ->given(
                $graphNode = new \mock\Novaway\Component\OpenGraph\Annotation\GraphNode('foo', 'bar'),
                $graphMetadata = new \mock\Novaway\Component\OpenGraph\Metadata\GraphMetadataInterface(),
                $this->testedInstance->addGraphMetadata($graphNode, $graphMetadata)
            )
            ->then
                ->array($this->testedInstance->nodes)
                    ->array[0]->isEqualTo(['node' => $graphNode, 'object' => $graphMetadata])
                    ->hasSize(1)

            ->given(
                $graphNode2 = new \mock\Novaway\Component\OpenGraph\Annotation\GraphNode('john', 'doe'),
                $graphMetadata2 = new \mock\Novaway\Component\OpenGraph\Metadata\GraphMetadataInterface(),
                $this->testedInstance->addGraphMetadata($graphNode2, $graphMetadata2)
            )
                ->array($this->testedInstance->nodes)
                    ->array[0]->isEqualTo(['node' => $graphNode, 'object' => $graphMetadata])
                    ->array[1]->isEqualTo(['node' => $graphNode2, 'object' => $graphMetadata2])
                    ->hasSize(2)
        ;
    }
}
