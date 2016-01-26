## Installation

### Install OpenGraph throug composer

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
