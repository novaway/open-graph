<?php

namespace Novaway\Component\OpenGraph\Metadata;

class MethodMetadata implements GraphMetadataInterface
{
    /** @var string */
    public $class;

    /** @var string */
    public $name;

    /** @var \ReflectionMethod */
    public $reflection;


    /**
     * Constructor
     *
     * @param string $class
     * @param string $name
     */
    public function __construct($class, $name)
    {
        $this->class = $class;
        $this->name  = $name;

        $this->reflection = new \ReflectionMethod($class, $name);
        $this->reflection->setAccessible(true);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue($containingValue)
    {
        return $this->reflection->invoke($containingValue);
    }
}
