<?php

namespace Novaway\Component\OpenGraph\View;

use Novaway\Component\OpenGraph\OpenGraphInterface;
use Novaway\Component\OpenGraph\OpenGraphTagInterface;

interface OpenGraphRendererInterface
{
    /**
     * Render Open Graph
     *
     * @param OpenGraphInterface $graph
     * @return string
     */
    public function render(OpenGraphInterface $graph);

    /**
     * Render Open Graph tag
     *
     * @param OpenGraphTagInterface $tag
     * @return string
     */
    public function renderTag(OpenGraphTagInterface $tag);
}
