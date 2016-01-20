<?php

namespace Novaway\Component\OpenGraph\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use Metadata\Driver\DriverInterface;
use Novaway\Component\OpenGraph\Metadata\ClassMetadata;

class AnnotationDriver implements DriverInterface
{
    /** @var Reader */
    private $reader;


    /**
     * Constructor
     *
     * @param Reader $reader
     */
    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Load metadata class
     *
     * @param \ReflectionClass $class
     * @return ClassMetadata
     */
    public function loadMetadataForClass(\ReflectionClass $class)
    {
        $classMetadata = new ClassMetadata($class->name);
        $classMetadata->fileResources[] = $class->getFileName();

        return $classMetadata;
    }
}
