<?php

namespace Novaway\Component\OpenGraph\tests\units\View;

use atoum;

class OpenGraphRenderer extends atoum
{
    public function testRenderNamespaceAttributes()
    {
        $this
            ->given($graph = new \mock\Novaway\Component\OpenGraph\OpenGraph())
            ->if($this->newTestedInstance())
            ->then
                ->string($this->testedInstance->renderNamespaceAttributes($graph))
                    ->isEmpty()

            ->given($graph->addNamespace('foo', 'uri://bar'))
            ->then
                ->string($this->testedInstance->renderNamespaceAttributes($graph))
                    ->isEqualTo('prefix="foo: uri://bar"')

            ->given($graph->addNamespace('john', 'uri://doe'))
            ->then
                ->string($this->testedInstance->renderNamespaceAttributes($graph))
                    ->isEqualTo('prefix="foo: uri://bar john: uri://doe"')
        ;
    }

    public function testRenderTag()
    {
        $this
            ->given($tag = new \mock\Novaway\Component\OpenGraph\OpenGraphTag('foo', 'bar', 'content'))
            ->if($this->newTestedInstance())
            ->then
                ->string($this->testedInstance->renderTag($tag))
                    ->isEqualTo('<meta property="foo:bar" content="content" />')

            ->given($tag = new \mock\Novaway\Component\OpenGraph\OpenGraphTag('foo', 'bar', ['content1', 'content2']))
            ->if($this->newTestedInstance())
            ->then
                ->string($this->testedInstance->renderTag($tag))
                    ->isEqualTo('<meta property="foo:bar" content="content1" /><meta property="foo:bar" content="content2" />')
        ;
    }

    public function testRender()
    {
        $this
            ->given(
                $graph = new \mock\Novaway\Component\OpenGraph\OpenGraph(),
                $graph->setTitle('Foo'),
                $graph->setType('object'),
                $graph->setUrl('http://url.com'),
                $graph->setLocaleAlternate(['FR_fr', 'FR_ca'])
            )
            ->if($this->newTestedInstance())
            ->then
                ->string($this->testedInstance->render($graph))
                    ->isEqualTo('<meta property="og:title" content="Foo" /><meta property="og:type" content="object" /><meta property="og:url" content="http://url.com" /><meta property="og:locale:alternate" content="FR_fr" /><meta property="og:locale:alternate" content="FR_ca" />')
        ;
    }
}
