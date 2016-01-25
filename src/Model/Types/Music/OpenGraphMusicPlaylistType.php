<?php

namespace Novaway\Component\OpenGraph\Model\Types\Music;

class OpenGraphMusicPlaylistType extends OpenGraphMusicType
{
    const TYPE = 'music.playlist';

    const PROPERTY_SONG       = 'song';
    const PROPERTY_SONG_DISC  = 'song:disc';
    const PROPERTY_SONG_TRACK = 'song:track';
    const PROPERTY_CREATOR    = 'creator';
}
