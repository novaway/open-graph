<?php

namespace Novaway\Component\OpenGraph\tests\units\Metadata;

use atoum;

class MetadataValue extends atoum
{
    public function testGetValue()
    {
        $this
            ->given($obj = new \mock\StdClass())
            ->if($this->newTestedInstance('foo'))
            ->then
                ->string($this->testedInstance->getValue($obj))
                    ->isEqualTo('foo')

            ->if($this->newTestedInstance(5))
            ->then
                ->integer($this->testedInstance->getValue($obj))
                    ->isEqualTo(5)

            ->if($this->newTestedInstance(['fizz', 'foo' => 'bar']))
            ->then
                ->array($this->testedInstance->getValue($obj))
                    ->string[0]->isEqualTo('fizz')
                    ->string['foo']->isEqualTo('bar')
                    ->hasSize(2)
        ;
    }
}
