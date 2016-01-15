<?php

namespace Novaway\Component\OpenGraph;

interface OpenGraphTagInterface
{
    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Get property
     *
     * @return string
     */
    public function getProperty();

    /**
     * Get content
     *
     * @return string
     */
    public function getContent();
}
