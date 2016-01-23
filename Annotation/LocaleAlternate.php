<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

/**
 * @Annotation
 * @Target({"CLASS", "PROPERTY", "METHOD"})
 */
class LocaleAlternate extends GraphNode
{
    public $value;


    public function __construct(array $values)
    {
        parent::__construct(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE_ALTERNATE);

        if (!empty($values['value'])) {
            if (!is_array($values['value'])) {
                $values['value'] = [$values['value']];
            }

            $this->value = $values['value'];
        }
    }
}
