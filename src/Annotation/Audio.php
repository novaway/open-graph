<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Audio extends GraphNode
{
    public function __construct()
    {
        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::AUDIO, ['uri' => OpenGraphMetadata::NAMESPACE_URL]);
    }
}
