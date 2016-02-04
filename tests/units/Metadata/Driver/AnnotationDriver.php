<?php

namespace Novaway\Component\OpenGraph\Tests\Units\Metadata\Driver;

use atoum;
use Doctrine\Common\Annotations\AnnotationReader;
use Novaway\Component\OpenGraph\Annotation\NamespaceNode;
use Novaway\Component\OpenGraph\Annotation\Node;
use Novaway\Component\OpenGraph\Annotation\Title;
use Novaway\Component\OpenGraph\Annotation\TwitterCards\AppCountry;
use Novaway\Component\OpenGraph\Annotation\TwitterCards\AppGooglePlayName;
use Novaway\Component\OpenGraph\Annotation\TwitterCards\AppIpadName;
use Novaway\Component\OpenGraph\Annotation\TwitterCards\AppIphoneName;
use Novaway\Component\OpenGraph\Annotation\TwitterCards\Card;
use Novaway\Component\OpenGraph\Annotation\TwitterCards\Creator;
use Novaway\Component\OpenGraph\Annotation\Type;
use Novaway\Component\OpenGraph\Annotation\Url;
use Novaway\Component\OpenGraph\Metadata\MetadataValue;
use Novaway\Component\OpenGraph\Metadata\MethodMetadata;
use Novaway\Component\OpenGraph\Metadata\PropertyMetadata;

class AnnotationDriver extends atoum
{
    public function testLoadMetadataForClass()
    {
        $this
            ->given($class = new \ReflectionClass('BlogPost'))
            ->if($this->newTestedInstance(new AnnotationReader()))
            ->then
                ->given($metadata = $this->testedInstance->loadMetadataForClass($class))
                ->object($metadata)
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\ClassMetadata')
                ->array($metadata->namespaces)
                    ->contains(new NamespaceNode(['prefix' => 'foo', 'uri' => 'bar']))
                    ->contains(new NamespaceNode(['prefix' => 'custom', 'uri' => 'http://path']))
                    ->hasSize(2)
                ->array($metadata->nodes)
                    ->contains(['node' => new Type(['value' => 'object']), 'object' => new MetadataValue('object')])
                    ->contains(['node' => new Title(), 'object' => new PropertyMetadata('BlogPost', 'title')])
                    ->contains(['node' => new Url(), 'object' => new MethodMetadata('BlogPost', 'getUrl')])
                    ->contains(['node' => $this->createCustomNode('custom', 'tag', ['value' => 'tagValue']), 'object' => new MetadataValue('tagValue')])
                    ->contains(['node' => $this->createCustomNode('og', 'site_name'), 'object' => new MethodMetadata('BlogPost', 'getCustomTag')])
                    ->hasSize(5)
        ;
    }

    public function testLoadMetadataForCustomClass()
    {
        $this
            ->given($class = new \ReflectionClass('Custom'))
            ->if($this->newTestedInstance(new AnnotationReader()))
            ->then
                ->given($metadata = $this->testedInstance->loadMetadataForClass($class))
                ->object($metadata)
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\ClassMetadata')
                ->array($metadata->namespaces)
                    ->contains(new NamespaceNode(['prefix' => 'foo', 'uri' => 'bar']))
                    ->hasSize(1)
                ->array($metadata->nodes)
                    ->contains(['node' => new Type(['value' => 'object']), 'object' => new MetadataValue('object')])
                    ->contains(['node' => $this->createCustomNode('custom', 'tag', ['value' => 'tagValue', 'namespaceUri' => 'http://path']), 'object' => new MetadataValue('tagValue')])
                    ->hasSize(2)
        ;
    }

    public function testLoadMetadataForApplicationClass()
    {
        $this
            ->given($class = new \ReflectionClass('Software\Application'))
            ->if($this->newTestedInstance(new AnnotationReader()))
            ->then
                ->given($metadata = $this->testedInstance->loadMetadataForClass($class))
                ->object($metadata)
                    ->isInstanceOf('Novaway\Component\OpenGraph\Metadata\ClassMetadata')
                ->array($metadata->namespaces)
                    ->isEmpty()
                ->array($metadata->nodes)
                    ->contains(['node' => new Card(['value' => 'app']), 'object' => new MetadataValue('app')])
                    ->contains(['node' => new AppCountry(['value' => 'FR_fr']), 'object' => new MetadataValue('FR_fr')])
                    ->contains(['node' => new AppIpadName(), 'object' => new PropertyMetadata('Software\Application', 'name')])
                    ->contains(['node' => new AppIphoneName(), 'object' => new PropertyMetadata('Software\Application', 'name')])
                    ->contains(['node' => new AppGooglePlayName(), 'object' => new PropertyMetadata('Software\Application', 'name')])
                    ->contains(['node' => new \Novaway\Component\OpenGraph\Annotation\TwitterCards\Url(), 'object' => new PropertyMetadata('Software\Application', 'url')])
                    ->contains(['node' => new Creator(), 'object' => new MethodMetadata('Software\Application', 'getCreator')])
                    ->hasSize(7)
        ;
    }

    private function createCustomNode($namespace, $tag, array $params = [])
    {
        $params = array_merge(['namespace' => $namespace, 'tag' => $tag], $params);

        $node = new Node($params);
        $node->namespace = $namespace;
        $node->tag       = $tag;

        return $node;
    }
}
