## Installation

### Install OpenGraph through composer

Simply run assuming you have installed composer :

``` bash
$ php composer.phar require novaway/open-graph "^1.0"
```

### Configuration

As the bundle use DoctrineAnnotations, if you want to use annotation feature,
you need to setup the `AnnotationRegistry` :

```php
use Doctrine\Common\Annotations\AnnotationRegistry;

AnnotationRegistry::registerLoader('class_exists');
```

The component can collect several metadata about your objects from differents
sources. In order to make the process as efficient as possible, it is encourage
to let the component cache that information. In this case, you can configure a
cache directory :

```php
use Novaway\Component\OpenGraph\OpenGraphGeneratorBuilder;

$generator = OpenGraphGeneratorBuilder::create()
    ->setCacheDirectory('/path/to/cache')
    ->setDebug($isDebugEnable)
    ->build();
```
