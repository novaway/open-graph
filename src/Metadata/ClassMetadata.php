<?php

namespace Novaway\Component\OpenGraph\Metadata;

use Metadata\MergeableClassMetadata;
use Novaway\Component\OpenGraph\Annotation\GraphNode;

class ClassMetadata extends MergeableClassMetadata
{
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

        $this->nodes = [];
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
