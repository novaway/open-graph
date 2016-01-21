<?php

namespace Novaway\Component\OpenGraph\Annotation;

abstract class GraphNode
{
    /** @var string */
    public $namespace;

    /** @var string */
    public $tag;


    /**
     * Constructor
     *
     * @param string $namespace
     * @param string $tag
     */
    public function __construct($namespace, $tag)
    {
        $this->namespace = $namespace;
        $this->tag       = $tag;
    }
}
