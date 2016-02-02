<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD"})
 */
class Locale extends GraphNode
{
    public function __construct(array $values)
    {
        $values = array_merge(['namespaceUri' => OpenGraphMetadata::NAMESPACE_URL], $values);

        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE, $values);
    }
}
