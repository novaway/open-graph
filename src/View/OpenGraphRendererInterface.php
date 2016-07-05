<?php

namespace Novaway\Component\OpenGraph\View;

use Novaway\Component\OpenGraph\OpenGraphInterface;
use Novaway\Component\OpenGraph\OpenGraphTagInterface;

interface OpenGraphRendererInterface
{
    /**
     * Render namespace attributes
     *
     * @param OpenGraphInterface $graph
     * @param bool               $withTag
     * @return string
     */
    public function renderNamespaceAttributes(OpenGraphInterface $graph, $withTag);

    /**
     * Render Open Graph
     *
     * @param OpenGraphInterface $graph
     * @param string             $tagSeparator
     * @return string
     */
    public function render(OpenGraphInterface $graph, $tagSeparator);

    /**
     * Render Open Graph tag
     *
     * @param OpenGraphTagInterface $tag
     * @return string
     */
    public function renderTag(OpenGraphTagInterface $tag);
}
