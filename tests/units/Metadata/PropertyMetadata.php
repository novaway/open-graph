<?php

namespace Novaway\Component\OpenGraph\tests\units\Metadata;

use atoum;

class PropertyMetadata extends atoum
{
    public function testGetValue()
    {
        $this
            ->given($obj = new \BlogPost())
            ->if($this->newTestedInstance('BlogPost', 'title'))
                ->string($this->testedInstance->getValue($obj))
                    ->isEqualTo('foo')

            ->if($this->newTestedInstance('BlogPost', 'field'))
                ->integer($this->testedInstance->getValue($obj))
                    ->isEqualTo(5)

            ->given(
                $obj = new \BlogPost(),
                $obj->field = ['toto']
            )
            ->if($this->newTestedInstance('BlogPost', 'field'))
                ->array($this->testedInstance->getValue($obj))
                    ->string[0]->isEqualTo('toto')
                    ->hasSize(1)
        ;
    }
}
