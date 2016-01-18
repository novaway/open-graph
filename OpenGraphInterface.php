<?php

namespace Novaway\Component\OpenGraph;

interface OpenGraphInterface
{
    /**
     * Get registered tags
     *
     * @return array
     */
    public function getTags();

    /**
     * Set the title of your object as it should appear within the graph
     *
     * @param string $title
     * @return OpenGraphInterface
     */
    public function setTitle($title);

    /**
     * Set the type of your object
     *
     * @param string $type
     * @return OpenGraphInterface
     */
    public function setType($type);

    /**
     * Set an image URL which should represent your object within the graph
     *
     * @param string $url
     * @return OpenGraphInterface
     */
    public function setUrl($url);

    /**
     * Set the canonical URL of your object that will be used as its permanent ID in the graph
     *
     * @param string $image
     * @return OpenGraphInterface
     */
    public function setImage($image);

    /**
     * Set an URL to an audio file to accompany this object
     *
     * @param string $url
     * @return OpenGraphInterface
     */
    public function setAudio($url);

    /**
     * Set one to two sentence description of your object
     *
     * @param string $description
     * @return OpenGraphInterface
     */
    public function setDesription($description);

    /**
     * Set the word that appears before this object's title in a sentence
     *
     * @param string $determiner
     * @return OpenGraphInterface
     */
    public function setDeterminer($determiner);

    /**
     * Set the locale these tags are marked up in
     *
     * @param string $locale
     * @return OpenGraphInterface
     */
    public function setLocale($locale);

    /**
     * Set an array of other locales this page is available in
     *
     * @param string $locale
     * @return OpenGraphInterface
     */
    public function setLocaleAlternate($locale);

    /**
     * Set the name which should be displayed for the overall site
     *
     * @param string $sitename
     * @return OpenGraphInterface
     */
    public function setSiteName($sitename);

    /**
     * Set an URL to a video file that complements this object
     *
     * @param string $url
     * @return OpenGraphInterface
     */
    public function setVideo($url);

    /**
     * Add an OpenGraph tag as a collection
     *
     * @param string $namespace
     * @param string $tag
     * @param string $content
     * @return OpenGraphInterface
     */
    public function add($namespace, $tag, $content);
}
