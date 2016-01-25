<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD"})
 */
class SiteName extends GraphNode
{
    public $value;


    public function __construct(array $values)
    {
        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::SITE_NAME);

        if (!empty($values['value'])) {
            if (!is_string($values['value'])) {
                throw new \InvalidArgumentException('OpenGraph sitename node need to be a string.');
            }

            $this->value = $values['value'];
        }
    }
}
