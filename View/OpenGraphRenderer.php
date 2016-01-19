<?php

namespace Novaway\Component\OpenGraph\View;

use Novaway\Component\OpenGraph\OpenGraphInterface;
use Novaway\Component\OpenGraph\OpenGraphTagInterface;

class OpenGraphRenderer implements OpenGraphRendererInterface
{
    /** @var string */
    protected static $tagTemplate = '<meta property="#property#" content="#content#" />';


    /**
     * {@inheritdoc}
     */
    public function renderNamespaceAttributes(OpenGraphInterface $graph)
    {
        $namespaces = $graph->getNamespaces();
        if (empty($namespaces)) {
            return '';
        }

        $attributes = '';
        foreach ($graph->getNamespaces() as $prefix => $uri) {
            if (!empty($attributes)) {
                $attributes .= ' ';
            }

            $attributes .= sprintf('%s: %s', $prefix, $uri);
        }

        return sprintf('prefix="%s"', $attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function render(OpenGraphInterface $graph)
    {
        $html = '';

        foreach ($graph->getTags() as $tag) {
            $html .= $this->renderTag($tag);
        }

        return $html;
    }

    /**
     * {@inheritdoc}
     */
    public function renderTag(OpenGraphTagInterface $tag)
    {
        return str_replace(
            ['#property#', '#content#'],
            [sprintf('%s:%s', $tag->getPrefix(), $tag->getProperty()), $tag->getContent()],
            self::$tagTemplate
        );
    }
}
