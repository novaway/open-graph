<?php

namespace Novaway\Component\OpenGraph\Metadata\Types\Video;

class OpenGraphVideoMovieType extends OpenGraphVideoType
{
    const TYPE = 'video.movie';

    const PROPERTY_ACTOR         = 'video:actor';
    const PROPERTY_ACTOR_ROLE    = 'video:actor:role';
    const PROPERTY_DIRECTOR      = 'video:director';
    const PROPERTY_WRITER        = 'video:writer';
    const PROPERTY_DURATION      = 'video:duration';
    const PROPERTY_REALEASE_DATE = 'video:release_date';
    const PROPERTY_TAG           = 'video:tag';
}
