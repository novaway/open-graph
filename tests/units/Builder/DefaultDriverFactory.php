<?php

namespace Novaway\Component\OpenGraph\tests\units\Builder;

use atoum;
use Doctrine\Common\Annotations\AnnotationReader;

class DefaultDriverFactory extends atoum
{
    public function testCreateDriver()
    {
        $this
            ->given($reader = new AnnotationReader())
            ->if($this->newTestedInstance())
            ->then
                ->object($this->testedInstance->createDriver([], $reader))
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\Driver\AnnotationDriver')

                ->given($chainDriver = $this->testedInstance->createDriver(['/path/to/dir'], $reader))
                ->object($chainDriver)
                    ->isInstanceOf('Metadata\Driver\DriverChain')
        ;
    }
}
