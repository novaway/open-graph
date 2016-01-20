<?php

namespace Novaway\Component\OpenGraph\Model\Types\Article;

class OpenGraphArticleType
{
    const NAMESPACE_TAG = 'ogarticle';
    const NAMESPACE_URL = 'http://ogp.me/ns/article#';

    const TYPE = 'article';

    const PROPERTY_PUBLISHED_TIME  = 'article:published_time';
    const PROPERTY_MODIFIED_TIME   = 'article:modified_time';
    const PROPERTY_EXPIRATION_TIME = 'article:expiration_time';
    const PROPERTY_AUTHOR          = 'article:author';
    const PROPERTY_SECTION         = 'article:section';
    const PROPERTY_TAG             = 'article:tag';
}
