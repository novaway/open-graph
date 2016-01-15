<?php

namespace Novaway\Component\OpenGraph\Metadata\Types\Music;

class OpenGraphMusicAlbumType extends OpenGraphMusicType
{
    const TYPE = 'music.album';

    const PROPERTY_SONG         = 'music:song';
    const PROPERTY_DISC         = 'music:song:disc';
    const PROPERTY_SONG_TRACK   = 'music:song:track';
    const PROPERTY_MUSICIAN     = 'music:musician';
    const PROPERTY_RELEASE_DATE = 'music:release_date';
}
