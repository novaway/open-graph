## Use `OpenGraph`

To assists OpenGraph generation, the library provide an `OpenGraph` object which
is use to define open graph nodes. This objet comes with a lot of pre-defined
data types which are located in the `Model` directory.

```php
use Novaway\Component\OpenGraph\OpenGraph;
use Novaway\Component\OpenGraph\Model\Types\Video\OpenGraphVideoMovieType;

$openGraph = new OpenGraph();
$openGraph
    ->setTitle('The Rock')
    ->setType(OpenGraphVideoMovieType::TYPE)
    ->setUrl('http://www.imdb.com/title/tt0117500/')
    ->setImage('http://ia.media-imdb.com/images/rock.jpg')
    ->add(OpenGraphVideoMovieType::NAMESPACE_TAG, OpenGraphVideoMovieType::PROPERTY_ACTOR, 'Nicolas Cage')
;
```

Open Graph namespace are not automatically generate. You need to specify them
explicitly :

```php
$openGraph->addNamespace(OpenGraphVideoMovieType::NAMESPACE_TAG, OpenGraphVideoMovieType::URI);
```
