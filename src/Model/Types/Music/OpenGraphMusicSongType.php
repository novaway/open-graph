<?php

namespace Novaway\Component\OpenGraph\Model\Types\Music;

class OpenGraphMusicSongType extends OpenGraphMusicType
{
    const TYPE = 'music.song';

    const PROPERTY_DURATION    = 'duration';
    const PROPERTY_ALBUM       = 'album';
    const PROPERTY_ALBUM_DISC  = 'album:disc';
    const PROPERTY_ALBUM_TRACK = 'album:track';
    const PROPERTY_MUSICIAN    = 'musician';
}
