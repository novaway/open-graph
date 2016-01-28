<?php

use Novaway\Component\OpenGraph\Annotation as OpenGraph;

/** @OpenGraph\Type("object") */
class BlogPost
{
    /** @OpenGraph\Title() */
    protected $title;

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
}
