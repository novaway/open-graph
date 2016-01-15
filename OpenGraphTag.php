<?php

namespace Novaway\Component\OpenGraph;

class OpenGraphTag implements OpenGraphTagInterface
{
    /** @var string */
    private $prefix;

    /** @var string */
    private $property;

    /** @var string */
    private $content;


    /**
     * Constructor
     *
     * @param string $prefix
     * @param string $property
     * @param string $content
     */
    public function __construct($prefix, $property, $content)
    {
        $this->prefix   = $prefix;
        $this->property = $property;
        $this->content  = $content;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->content;
    }
}
