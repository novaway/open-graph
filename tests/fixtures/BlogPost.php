<?php

use Novaway\Component\OpenGraph\Annotation as OpenGraph;

/**
 * @OpenGraph\Type("object")
 * @OpenGraph\Node(namespace="custom", tag="tag", value="tagValue")
 * @OpenGraph\NamespaceNode(prefix="custom", uri="http://path")
 * @OpenGraph\NamespaceNode(prefix="foo", uri="bar")
 */
class BlogPost
{
    /** @OpenGraph\Title() */
    protected $title;

    /** @var int  */
    public $field = 5;


    public function __construct()
    {
        $this->title = 'foo';
    }

    /**
     * @OpenGraph\Url()
     */
    public function getUrl()
    {
        return 'http://uri';
    }

    public function getLength()
    {
        return 25;
    }

    /**
     * @OpenGraph\Node(namespace="og", tag="site_name")
     */
    public function getCustomTag()
    {
        return 'http://uri.com';
    }
}
