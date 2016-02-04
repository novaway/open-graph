<?php

namespace Software;

use Novaway\Component\OpenGraph\Annotation\TwitterCards as TwitterCard;
use Novaway\Component\OpenGraph\Model\Types\TwitterCardsType;

/**
 * @TwitterCard\Card(TwitterCardsType::TYPE_APP)
 * @TwitterCard\AppCountry("FR_fr")
 */
class Application
{
    /**
     * @TwitterCard\AppGooglePlayName()
     * @TwitterCard\AppIpadName()
     * @TwitterCard\AppIphoneName()
     */
    public $name = 'My app';

    /** @TwitterCard\Url() */
    public $url;

    public function __construct()
    {
        $this->url = 'http://company.com/myapp';
    }

    /** @TwitterCard\Creator() */
    public function getCreator()
    {
        return '@JohnDoe';
    }
}
