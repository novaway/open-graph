<?php

namespace Novaway\Component\OpenGraph\Annotation\TwitterCards;

use Novaway\Component\OpenGraph\Annotation\GraphNode;
use Novaway\Component\OpenGraph\Model\Types\TwitterCardsType;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class AppIphoneUrl extends GraphNode
{
    public function __construct()
    {
        parent::__construct(TwitterCardsType::NAMESPACE_TAG, TwitterCardsType::APP_IPHONE_URL);
    }
}
