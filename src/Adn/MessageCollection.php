<?php namespace Purplapp\Adn;

use stdClass;

class MessageCollection
{
    use DataCollectionTrait;

    protected function transform(stdClass $object)
    {
        return Message::wrap($object);
    }
}
