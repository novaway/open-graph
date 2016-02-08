## Generate OpenGraph through annotations

The component allows developer to generate automatically an OpenGraph through
an YAML file configuration. By default, it uses Doctrine annotations, but you
may also store metadata in YAML files. In that case, it is neccessary to
configure a metadata directory where those files are located :

```php
use Novaway\Component\OpenGraph\OpenGraphGeneratorBuilder;

$generator = OpenGraphGeneratorBuilder::create()
    ->addMetadataDir('/path/to/metadata')
    ->addMetadataDir('/path/to/metadata2', 'NamespacePrefix')
    ->build();
```

Then create your YAML file configuration :

```yaml
NamespacePrefix\MyClass:
    namespaces:
        og:  'http://ogp.me/ns#'
        foo: 'bar'

    nodes:
        title:
            - namespace: 'og'
              tag:       'title'
            - namespace: 'twitter'
              tag:       'title'

        getDescription:
            - namespace: 'og'
              tag:       'description'
```

After adding all configuration, you can use the `OpenGraphGenerator`
to parse your object and get an `OpenGraph` object :


```php
use Novaway\Component\OpenGraph\OpenGraphGeneratorBuilder;

$instance = new NamespacePrefix\MyClass();
// ...

$ogGenerator = OpenGraphGeneratorBuilder::create()->build();
$openGraph = $ogGenerator->generate($instance);
```
