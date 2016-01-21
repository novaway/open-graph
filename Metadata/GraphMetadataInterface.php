<?php

namespace Novaway\Component\OpenGraph\Metadata;

interface GraphMetadataInterface
{
    /**
     * Get field value
     *
     * @param mixed $containingValue
     * @return mixed
     */
    public function getValue($containingValue);
}
