<?php

namespace Novaway\Component\OpenGraph\Tests\Units\Metadata\Driver;

use atoum;
use Novaway\Component\OpenGraph\Annotation\Node;

abstract class AbstractDriver extends atoum
{
    protected function createCustomNode($namespace, $tag, array $params = [])
    {
        $params = array_merge(['namespace' => $namespace, 'tag' => $tag], $params);

        $node = new Node($params);
        $node->namespace = $namespace;
        $node->tag       = $tag;

        return $node;
    }
}
