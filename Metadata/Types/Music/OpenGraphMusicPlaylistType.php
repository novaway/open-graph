<?php

namespace Novaway\Component\OpenGraph\Metadata\Types\Music;

class OpenGraphMusicPlaylistType extends OpenGraphMusicType
{
    const TYPE = 'music.playlist';

    const PROPERTY_SONG       = 'music:song';
    const PROPERTY_SONG_DISC  = 'music:song:disc';
    const PROPERTY_SONG_TRACK = 'music:song:track';
    const PROPERTY_CREATOR    = 'music:creator';
}
