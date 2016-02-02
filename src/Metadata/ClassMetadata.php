<?php

namespace Novaway\Component\OpenGraph\Metadata;

use Metadata\MergeableClassMetadata;
use Novaway\Component\OpenGraph\Annotation\GraphNode;
use Novaway\Component\OpenGraph\Annotation\NamespaceNode;

class ClassMetadata extends MergeableClassMetadata
{
    /** @var NamespaceNode[] */
    public $namespaces;

    /** @var GraphMetadataInterface[] */
    public $nodes;


    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->namespaces = [];
        $this->nodes      = [];
    }

    /**
     * Add OpenGraph namespace
     *
     * @param NamespaceNode $namespace
     * @return ClassMetadata
     */
    public function addGraphNamespace(NamespaceNode $namespace)
    {
        $this->namespaces[] = $namespace;

        return $this;
    }

    /**
     * Add OpenGraph metadata
     *
     * @param GraphNode              $type
     * @param GraphMetadataInterface $data
     * @return ClassMetadata
     */
    public function addGraphMetadata(GraphNode $node, GraphMetadataInterface $data)
    {
        $this->nodes[] = [
            'node'   => $node,
            'object' => $data,
        ];

        return $this;
    }
}
