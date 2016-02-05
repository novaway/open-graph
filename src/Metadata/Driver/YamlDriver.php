<?php

namespace Novaway\Component\OpenGraph\Metadata\Driver;

use Novaway\Component\OpenGraph\Annotation\NamespaceNode;
use Novaway\Component\OpenGraph\Annotation\Node;
use Novaway\Component\OpenGraph\Metadata\ClassMetadata;
use Metadata\Driver\AbstractFileDriver;
use Novaway\Component\OpenGraph\Metadata\MethodMetadata;
use Novaway\Component\OpenGraph\Metadata\PropertyMetadata;
use Symfony\Component\Yaml\Yaml;

class YamlDriver extends AbstractFileDriver
{
    /**
     * {@inheritdoc}
     */
    protected function loadMetadataFromFile(\ReflectionClass $class, $file)
    {
        $name = $class->name;

        $config = Yaml::parse(file_get_contents($file));
        if (!isset($config[$name])) {
            throw new \RuntimeException(sprintf('Expected metadata for class %s to be defined in %s.', $class->name, $file));
        }

        $config = $config[$name];

        $classMetadata = new ClassMetadata($name);

        $this->parseNamespaces($classMetadata, $config);
        $this->parseNodes($class, $classMetadata, $config);

        return $classMetadata;
    }

    /**
     * {@inheritdoc}
     */
    protected function getExtension()
    {
        return 'yml';
    }

    /**
     * Parse namespaces configuration
     *
     * @param ClassMetadata $metadata
     * @param mixed         $config
     */
    protected function parseNamespaces(ClassMetadata $metadata, $config)
    {
        if (!isset($config['namespaces'])) {
            return;
        }

        if (!is_array($config)) {
            throw new \RuntimeException(sprintf('Invalid YAML configuration for "%s" : "namespaces" property need to be an array.', $metadata->name));
        }

        foreach ($config['namespaces'] as $prefix => $uri) {
            $metadata->addGraphNamespace(new NamespaceNode([
                'prefix' => $prefix,
                'uri'    => $uri,
            ]));
        }
    }

    /**
     * Parse OpenGraph node properties
     *
     * @param \ReflectionClass $class
     * @param ClassMetadata    $metadata
     * @param mixed            $config
     */
    protected function parseNodes(\ReflectionClass $class, ClassMetadata $metadata, $config)
    {
        if (!isset($config['nodes'])) {
            return;
        }

        if (!is_array($config)) {
            throw new \RuntimeException(sprintf('Invalid YAML configuration for "%s" : "properties" property need to be an array.', $metadata->name));
        }

        foreach ($config['nodes'] as $property => $nodeProperties) {
            foreach ($nodeProperties as $nodeProperty) {
                if (!isset($nodeProperty['namespace']) || !isset($nodeProperty['tag'])) {
                    throw new \RuntimeException(sprintf('Invalid YAML configuration for "%s" : "namespace" and "tag" are required.', $metadata->name));
                }

                $node = new Node([
                    'namespace' => $nodeProperty['namespace'],
                    'tag' => $nodeProperty['tag'],
                ]);

                if ($class->hasProperty($property)) {
                    $metadata->addGraphMetadata($node, new PropertyMetadata($class->name, $property));
                }

                if ($class->hasMethod($property)) {
                    $metadata->addGraphMetadata($node, new MethodMetadata($class->name, $property));
                }
            }
        }
    }
}
