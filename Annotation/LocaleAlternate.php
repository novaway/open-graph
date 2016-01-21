<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class LocaleAlternate extends GraphNode
{
    public function __construct()
    {
        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE_ALTERNATE);
    }
}
