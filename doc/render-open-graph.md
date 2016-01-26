## Render an OpenGraph as HTML

The goal of an `OpenGraph` object is to be render as HTML. In this
case the library provide an default render object, you case use
like in this example :

```php
use Novaway\Component\OpenGraph\View\OpenGraphRenderer;

$openGraph = new OpenGraph();
// ...

$ogRenderer = OpenGraphRenderer::create();

$attributes = $ogRenderer->renderNamespaceAttributes($openGraph);
echo $attributes;

$html = $ogRenderer->render($openGraph);
echo $html;
```
