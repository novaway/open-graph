<?php

namespace Novaway\Component\OpenGraph;

use Metadata\MetadataFactoryInterface;

class OpenGraphGenerator
{
    /** @var MetadataFactoryInterface */
    private $factory;


    /**
     * Constructor
     *
     * @param MetadataFactoryInterface $factory
     */
    public function __construct(MetadataFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Generate OpenGraph through metadata
     *
     * @param object $obj
     * @return OpenGraphInterface
     */
    public function generate($obj)
    {
        if (!is_object($obj)) {
            throw new \InvalidArgumentException('OpenGraphGenerator::generate only accept object argument.');
        }

        $openGraph = new OpenGraph();

        $classType = get_class($obj);

        $metadata = $this->factory->getMetadataForClass($classType);
        foreach ($metadata->nodes as $graphNode) {
            $openGraph->add($graphNode['node']->namespace, $graphNode['node']->tag, $graphNode['object']->getValue($obj));
        }

        return $openGraph;
    }
}