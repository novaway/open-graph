<?php

namespace Novaway\Component\OpenGraph;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\FilesystemCache;
use Metadata\Cache\FileCache;
use Metadata\MetadataFactory;
use Novaway\Component\OpenGraph\Builder\DefaultDriverFactory;

class OpenGraphGeneratorBuilder
{
    /** @var Reader */
    private $annotationReader;

    /** @var array */
    private $metadataDirectories;

    /** @var string */
    private $cacheDirectory;

    /** @var DefaultDriverFactory */
    private $driverFactory;

    /** @var bool */
    private $debug;

    /** @var bool */
    private $includeInterfaceMetadata;


    /**
     * Create builder instance
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->driverFactory = new DefaultDriverFactory();

        $this->debug = false;
        $this->includeInterfaceMetadata = false;
        $this->metadataDirectories = [];
    }

    /**
     * Create open graph object
     */
    public function build()
    {
        $annotationReader = $this->annotationReader;
        if (null === $annotationReader) {
            $annotationReader = new AnnotationReader();
            if (null !== $this->cacheDirectory) {
                $cacheDirectory = sprintf('%s/annotations', $this->cacheDirectory);

                $this->createDirectory($cacheDirectory);
                $annotationReader = new CachedReader($annotationReader, new FilesystemCache($cacheDirectory));
            }
        }

        $metadataDriver  = $this->driverFactory->createDriver($this->metadataDirectories, $annotationReader);

        $metadataFactory = new MetadataFactory($metadataDriver, null, $this->debug);
        $metadataFactory->setIncludeInterfaces($this->includeInterfaceMetadata);

        if (null !== $this->cacheDirectory) {
            $directory = sprintf('%s/metadata', $this->cacheDirectory);

            $this->createDirectory($directory);
            $metadataFactory->setCache(new FileCache($directory));
        }

        return new OpenGraphGenerator($metadataFactory);
    }

    /**
     * Set debug
     *
     * @param bool $debug
     * @return $this
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;

        return $this;
    }

    /**
     * Include the metadata from the interfaces
     *
     * @param bool $include
     * @return $this
     */
    public function setIncludeInterfaceMetadata($include)
    {
        $this->includeInterfaceMetadata = $include;

        return $this;
    }

    /**
     * Set annotation reader
     *
     * @param Reader $reader
     * @return OpenGraphGeneratorBuilder
     */
    public function setAnnotationReader(Reader $reader)
    {
        $this->annotationReader = $reader;

        return $this;
    }

    /**
     * Set cache directory
     *
     * @param string $directory
     * @return OpenGraphGeneratorBuilder
     */
    public function setCacheDirectory($directory)
    {
        if (!is_dir($directory)) {
            $this->createDirectory($directory);
        }

        if (!is_writable($directory)) {
            throw new \InvalidArgumentException(sprintf('The cache directory "%s" is not writable.', $dir));
        }

        $this->cacheDirectory = $directory;

        return $this;
    }

    /**
     * Sets a map of namespace prefixes to directories.
     *
     * @param array $namespacePrefixToDirMap
     * @return OpenGraphGeneratorBuilder
     * @throws \InvalidArgumentException
     */
    public function setMetadataDirs(array $namespacePrefixToDirMap)
    {
        foreach ($namespacePrefixToDirMap as $dir) {
            if (!is_dir($dir)) {
                throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
            }
        }

        $this->metadataDirectories = $namespacePrefixToDirMap;

        return $this;
    }

    /**
     * Adds a directory where the generator will look for class metadata.
     *
     * @param string $dir
     * @param string $namespacePrefix
     * @return OpenGraphGeneratorBuilder
     * @throws \InvalidArgumentException
     */
    public function addMetadataDir($dir, $namespacePrefix = '')
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
        }

        if (isset($this->metadataDirectories[$namespacePrefix])) {
            throw new \InvalidArgumentException(sprintf('There is already a directory configured for the namespace prefix "%s". Please use replaceMetadataDir() to override directories.', $namespacePrefix));
        }

        $this->metadataDirectories[$namespacePrefix] = $dir;

        return $this;
    }

    /**
     * Adds a map of namespace prefixes to directories.
     *
     * @param array $namespacePrefixToDirMap
     * @return OpenGraphGeneratorBuilder
     */
    public function addMetadataDirs(array $namespacePrefixToDirMap)
    {
        foreach ($namespacePrefixToDirMap as $prefix => $dir) {
            $this->addMetadataDir($dir, $prefix);
        }

        return $this;
    }

    /**
     * Similar to addMetadataDir(), but overrides an existing entry.
     *
     * @param string $dir
     * @param string $namespacePrefix
     * @return OpenGraphGeneratorBuilder
     * @throws \InvalidArgumentException
     */
    public function replaceMetadataDir($dir, $namespacePrefix = '')
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(sprintf('The directory "%s" does not exist.', $dir));
        }

        if (!isset($this->metadataDirectories[$namespacePrefix])) {
            throw new \InvalidArgumentException(sprintf('There is no directory configured for namespace prefix "%s". Please use addMetadataDir() for adding new directories.', $namespacePrefix));
        }

        $this->metadataDirectories[$namespacePrefix] = $dir;

        return $this;
    }

    /**
     * Create directory
     *
     * @param string $directory
     */
    private function createDirectory($directory)
    {
        if (is_dir($directory)) {
            return;
        }

        if (false === @mkdir($directory, 0777, true)) {
            throw new \RuntimeException(sprintf('Could not create directory "%s".', $dir));
        }
    }
}
