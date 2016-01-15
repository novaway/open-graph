<?php

namespace Novaway\Component\OpenGraph;

use Novaway\Component\OpenGraph\Metadata\OpenGraphMetadata;

class OpenGraph implements OpenGraphInterface
{
    /** @var array */
    private $tags;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = [];
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
    public function setTitle($title)
    {
        $this->tags[OpenGraphMetadata::TITLE] = new OpenGraphTag(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::TITLE, $title);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->tags[OpenGraphMetadata::TYPE] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::TYPE, $type);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->tags[OpenGraphMetadata::URL] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::URL, $url);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image)
    {
        $this->tags[OpenGraphMetadata::IMAGE] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::IMAGE, $image);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setAudio($url)
    {
        $this->tags[OpenGraphMetadata::AUDIO] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::AUDIO, $url);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDesription($description)
    {
        $this->tags[OpenGraphMetadata::DESCRIPTION] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::DESCRIPTION, $description);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setDeterminer($determiner)
    {
        $this->tags[OpenGraphMetadata::DETERMINER] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::DETERMINER, $determiner);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->tags[OpenGraphMetadata::LOCALE] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE, $locale);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocaleAlternate($locale)
    {
        $this->tags[OpenGraphMetadata::LOCALE_ALTERNATE] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::LOCALE_ALTERNATE, $locale);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setSiteName($sitename)
    {
        $this->tags[OpenGraphMetadata::SITE_NAME] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::SITE_NAME, $sitename);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setVideo($url)
    {
        $this->tags[OpenGraphMetadata::VIDEO] = new OpenGraphMetadata(OpenGraphMetadata::NAMESPACE_TAG, OpenGraphMetadata::VIDEO, $url);

        return $this;
    }
}
