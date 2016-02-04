<?php

namespace Novaway\Component\OpenGraph\Annotation\TwitterCards;

use Novaway\Component\OpenGraph\Annotation\GraphNode;
use Novaway\Component\OpenGraph\Model\Types\TwitterCardsType;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD"})
 */
class Title extends GraphNode
{
    public function __construct(array $values)
    {
        parent::__construct(TwitterCardsType::NAMESPACE_TAG, TwitterCardsType::TITLE);
    }
}
