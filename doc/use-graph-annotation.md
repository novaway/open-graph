## Generate OpenGraph through annotations

The component allows developer to generate automatically an OpenGraph through
various annoations which can be used in PHP classes.

> All annotations are located in `Annotation` directory

```php
use Novaway\Component\OpenGraph\Annotation as OpenGraph;

/** @OpenGraph\Type("object") */
class PostBlog
{
    /** @OpenGraph\Title() */
    protected $title;

    /** @OpenGraph\Image() */
    public $imageUrl = "Image";

    private $url;

    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @OpenGraph\Url()
     */
    public function getUrl()
    {
        return $this->url;
    }
}
```

After adding annotation in your object, you need to call `generate`
method of `OpenGraphGeneratorBuilder` to parse your object and get
an `OpenGraph` object :


```php
use Novaway\Component\OpenGraph\OpenGraphGeneratorBuilder;

$myPost = new PostBlog('Post title');
// ...

$ogGenerator = OpenGraphGeneratorBuilder::create()->build();
$openGraph = $ogGenerator->generate($myPost);
```