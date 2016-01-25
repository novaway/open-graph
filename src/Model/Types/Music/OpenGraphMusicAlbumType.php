<?php

namespace Novaway\Component\OpenGraph\Model\Types\Music;

class OpenGraphMusicAlbumType extends OpenGraphMusicType
{
    const TYPE = 'music.album';

    const PROPERTY_SONG         = 'song';
    const PROPERTY_DISC         = 'song:disc';
    const PROPERTY_SONG_TRACK   = 'song:track';
    const PROPERTY_MUSICIAN     = 'musician';
    const PROPERTY_RELEASE_DATE = 'release_date';
}
