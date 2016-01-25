<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD"})
 */
class Locale extends GraphNode
{
    public $value;


    public function __construct(array $values)
    {
        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE);

        if (!empty($values['value'])) {
            if (!is_string($values['value'])) {
                throw new \InvalidArgumentException('OpenGraph locale node need to be a string.');
            }

            $this->value = $values['value'];
        }
    }
}
