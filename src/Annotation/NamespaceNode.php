<?php

namespace Novaway\Component\OpenGraph\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;

/**
 * @Annotation
 * @Target({"CLASS"})
 */
class NamespaceNode
{
    /**
     * @Required
     * @var string
     */
    public $prefix;

    /**
     * @Required
     * @var string
     */
    public $uri;


    public function __construct(array $values)
    {
        $this->prefix = $values['prefix'];
        $this->uri    = $values['uri'];
    }
}
