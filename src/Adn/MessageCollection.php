<?php namespace Purplapp\Adn;

use stdClass;

class MessageCollection extends Collection
{
    protected function transform(stdClass $object)
    {
        return Message::wrap($object);
    }
}
