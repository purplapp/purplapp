<?php namespace Purplapp\Adn;

use stdClass;

class NiceRankCollection
{
    use DataCollectionTrait;

    protected function transform(stdClass $object)
    {
        return NiceRank::wrap($object);
    }
}
