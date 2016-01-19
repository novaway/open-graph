<?php

namespace Novaway\Component\OpenGraph\Tests\Units;

use atoum;

class OpenGraph extends atoum
{
    public function testAdd()
    {
        $this
            ->if($this->newTestedInstance())
            ->then
                ->array($this->testedInstance->getTags())
                    ->isEmpty()

            ->given($this->testedInstance->add('foo', 'bar', 'content'))
            ->then
                ->array($this->testedInstance->getTags())
                    ->object[0]->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTagInterface')
                    ->hasSize(1)

            ->given($this->testedInstance->add('foo', 'bar', 'content'))
            ->then
                ->array($this->testedInstance->getTags())
                    ->object[0]->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTagInterface')
                    ->object[1]->isInstanceOf('Novaway\Component\OpenGraph\OpenGraphTagInterface')
                    ->hasSize(2)
        ;
    }

    public function testAddNamespace()
    {
        $this
            ->if($this->newTestedInstance())
            ->then
                ->array($this->testedInstance->getNamespaces())
                    ->isEmpty()

            ->given($this->testedInstance->addNamespace('foo', 'uri://bar'))
            ->then
                ->array($this->testedInstance->getNamespaces())
                    ->string['foo']->isEqualTo('uri://bar')
                    ->hasSize(1)

            ->given($this->testedInstance->addNamespace('john', 'doe'))
            ->then
                ->array($this->testedInstance->getNamespaces())
                    ->string['foo']->isEqualTo('uri://bar')
                    ->string['john']->isEqualTo('doe')
                    ->hasSize(2)
        ;
    }
}
