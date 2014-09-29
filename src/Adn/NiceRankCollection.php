<?php namespace Purplapp\Adn;

use stdClass;

class NiceRankCollection extends Collection
{
    protected function transform(stdClass $object)
    {
        return NiceRank::wrap($object);
    }
}
