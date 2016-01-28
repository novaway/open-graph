<?php

namespace Novaway\Component\OpenGraph\Tests\Units\Metadata\Driver;

use atoum;
use Doctrine\Common\Annotations\AnnotationReader;
use Novaway\Component\OpenGraph\Annotation\Title;
use Novaway\Component\OpenGraph\Annotation\Type;
use Novaway\Component\OpenGraph\Annotation\Url;
use Novaway\Component\OpenGraph\Metadata\MetadataValue;
use Novaway\Component\OpenGraph\Metadata\MethodMetadata;
use Novaway\Component\OpenGraph\Metadata\PropertyMetadata;

class AnnotationDriver extends atoum
{
    public function testLoadMetadataForClass()
    {
        $this
            ->given($class = new \ReflectionClass('BlogPost'))
            ->if($this->newTestedInstance(new AnnotationReader()))
            ->then
                ->given($metadata = $this->testedInstance->loadMetadataForClass($class))
                ->object($metadata)
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\ClassMetadata')
                ->array($metadata->nodes)
                    ->contains(['node' => new Type(['value' => 'object']), 'object' => new MetadataValue('object')])
                    ->contains(['node' => new Title(), 'object' => new PropertyMetadata('BlogPost', 'title')])
                    ->contains(['node' => new Url(), 'object' => new MethodMetadata('BlogPost', 'getUrl')])
                    ->hasSize(3)
        ;
    }
}
