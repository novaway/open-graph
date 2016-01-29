<?php

namespace Novaway\Component\OpenGraph\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use Metadata\Driver\DriverInterface;
use Novaway\Component\OpenGraph\Annotation\GraphNode;
use Novaway\Component\OpenGraph\Metadata\ClassMetadata;
use Novaway\Component\OpenGraph\Metadata\MetadataValue;
use Novaway\Component\OpenGraph\Metadata\MethodMetadata;
use Novaway\Component\OpenGraph\Metadata\PropertyMetadata;

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

        foreach ($this->reader->getClassAnnotations($class) as $annotation) {
            if ($annotation instanceof GraphNode) {
                $classMetadata->addGraphMetadata($annotation, new MetadataValue($annotation->value));
            }
        }

        foreach ($class->getProperties() as $property) {
            foreach ($this->reader->getPropertyAnnotations($property) as $annotation) {
                if ($annotation instanceof GraphNode) {
                    $classMetadata->addGraphMetadata($annotation, new PropertyMetadata($class->name, $property->name));
                }
            }
        }

        foreach ($class->getMethods() as $method) {
            foreach ($this->reader->getMethodAnnotations($method) as $annotation) {
                if ($annotation instanceof GraphNode) {
                    $classMetadata->addGraphMetadata($annotation, new MethodMetadata($class->name, $method->name));
                }
            }
        }

        return $classMetadata;
    }
}
