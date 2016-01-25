<?php

namespace Novaway\Component\OpenGraph;

use Novaway\Component\OpenGraph\Model\OpenGraphMetadata;

class OpenGraph implements OpenGraphInterface
{
    /** @var OpenGraphTagInterface[] */
    private $tags;

    /** @var array */
    private $namespaces;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags       = [];
        $this->namespaces = [];
    }

    /**
     * {@inheritdoc}
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::TITLE, $title);
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::TYPE, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::URL, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::IMAGE, $image);
    }

    /**
     * {@inheritdoc}
     */
    public function setAudio($url)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::AUDIO, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function setDesription($description)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::DESCRIPTION, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function setDeterminer($determiner)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::DETERMINER, $determiner);
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function setLocaleAlternate($locale)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE_ALTERNATE, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function setSiteName($sitename)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::SITE_NAME, $sitename);
    }

    /**
     * {@inheritdoc}
     */
    public function setVideo($url)
    {
        return $this->add(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::VIDEO, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function add($namespace, $tag, $content)
    {
        $this->tags[] = new OpenGraphTag($namespace, $tag, $content);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addNamespace($prefix, $uri)
    {
        $this->namespaces[$prefix] = $uri;

        return $this;
    }
}
