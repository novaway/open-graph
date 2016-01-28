<?php

namespace Novaway\Component\OpenGraph\tests\units\Metadata;

use atoum;

class MethodMetadata extends atoum
{
    public function testGetValue()
    {
        $this
            ->given($obj = new \BlogPost())
            ->if($this->newTestedInstance('BlogPost', 'getUrl'))
            ->then
                ->string($this->testedInstance->getValue($obj))
                    ->isEqualTo('http://uri')

            ->if($this->newTestedInstance('BlogPost', 'getLength'))
                ->integer($this->testedInstance->getValue($obj))
                    ->isEqualTo(25)
        ;
    }
}
