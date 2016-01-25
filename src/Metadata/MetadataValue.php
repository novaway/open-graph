<?php

namespace Novaway\Component\OpenGraph\Metadata;

class MetadataValue implements GraphMetadataInterface
{
    /** @var mixed */
    private $value;


    /**
     * Constructor
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue($containingValue)
    {
        return $this->value;
    }
}
