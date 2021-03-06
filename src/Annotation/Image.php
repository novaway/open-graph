<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Image extends GraphNode
{
    public function __construct()
    {
        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::IMAGE, ['namespaceUri' => OpenGraphMetadata::NAMESPACE_URL]);
    }
}
