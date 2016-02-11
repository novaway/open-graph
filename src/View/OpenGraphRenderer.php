<?php

namespace Novaway\Component\OpenGraph\View;

use Novaway\Component\OpenGraph\OpenGraphInterface;
use Novaway\Component\OpenGraph\OpenGraphTag;
use Novaway\Component\OpenGraph\OpenGraphTagInterface;

class OpenGraphRenderer implements OpenGraphRendererInterface
{
    /** @var string */
    protected static $tagTemplate = '<meta property="#property#" content="#content#" />';


    /**
     * Create renderer instance
     *
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * {@inheritdoc}
     */
    public function renderNamespaceAttributes(OpenGraphInterface $graph, $withTag = true)
    {
        $namespaces = $graph->getNamespaces();
        if (empty($namespaces)) {
            return '';
        }

        $attributes = '';
        foreach ($namespaces as $prefix => $uri) {
            if (!empty($attributes)) {
                $attributes .= ' ';
            }

            $attributes .= sprintf('%s: %s', $prefix, $uri);
        }

        if ($withTag) {
            $attributes = sprintf('prefix="%s"', $attributes);
        }

        return $attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function render(OpenGraphInterface $graph, $tagSeparator = '')
    {
        $html = '';

        foreach ($graph->getTags() as $tag) {
            if (!empty($html)) {
                $html .= $tagSeparator;
            }

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
