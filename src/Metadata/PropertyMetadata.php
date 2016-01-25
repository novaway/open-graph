<?php

namespace Novaway\Component\OpenGraph\Metadata;

class PropertyMetadata implements GraphMetadataInterface
{
    /** @var string */
    public $class;

    /** @var string */
    public $name;

    /** @var \ReflectionProperty */
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

        $this->reflection = new \ReflectionProperty($class, $name);
        $this->reflection->setAccessible(true);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue($containingValue)
    {
        return $this->reflection->getValue($containingValue);
    }
}
