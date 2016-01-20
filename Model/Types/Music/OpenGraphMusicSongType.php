<?php

namespace Novaway\Component\OpenGraph\Model\Types\Music;

class OpenGraphMusicSongType extends OpenGraphMusicType
{
    const TYPE = 'music.song';

    const PROPERTY_DURATION    = 'music:duration';
    const PROPERTY_ALBUM       = 'music:album';
    const PROPERTY_ALBUM_DISC  = 'music:album:disc';
    const PROPERTY_ALBUM_TRACK = 'music:album:track';
    const PROPERTY_MUSICIAN    = 'music:musician';
}
