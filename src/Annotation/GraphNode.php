<?php

namespace Novaway\Component\OpenGraph\Annotation;

abstract class GraphNode
{
    /** @var string */
    public $namespace;

    /** @var string */
    public $namespaceUri;

    /** @var string */
    public $tag;

    /** @var string */
    public $value;


    /**
     * Constructor
     *
     * @param string $namespace
     * @param string $tag
     * @param array  $values
     */
    public function __construct($namespace, $tag, array $values = [])
    {
        $this->namespace = $namespace;
        $this->tag       = $tag;

        if (isset($values['namespaceUri'])) {
            $this->namespaceUri = $values['namespaceUri'];
        }

        if (isset($values['value'])) {
            $this->value = $values['value'];
        }
    }
}
