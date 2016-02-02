<?php

namespace Novaway\Component\OpenGraph\Annotation;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD"})
 */
class Node extends GraphNode
{
    /**
     * @Required
     * @var string
     */
    public $namespace;

    /**
     * @Required
     * @var string
     */
    public $tag;

    /** @var string */
    public $value;


    public function __construct(array $values = [])
    {
        parent::__construct($values['namespace'], $values['tag'], $values);
    }
}
