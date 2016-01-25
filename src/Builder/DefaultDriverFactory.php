<?php

namespace Novaway\Component\OpenGraph\Builder;

use Doctrine\Common\Annotations\Reader;
use Metadata\Driver\DriverChain;
use Metadata\Driver\FileLocator;
use Novaway\Component\OpenGraph\Metadata\Driver\AnnotationDriver;

class DefaultDriverFactory
{
    /**
     * Create driver
     *
     * @param array  $metadataDirs
     * @param Reader $annotationReader
     * @return DefaultDriverFactory
     */
    public function createDriver(array $metadataDirectories, Reader $annotationReader)
    {
        if (!empty($metadataDirectories)) {
            $fileLocator = new FileLocator($metadataDirectories);

            return new DriverChain([
                new AnnotationDriver($annotationReader),
            ]);
        }

        return new AnnotationDriver($annotationReader);
    }
}
