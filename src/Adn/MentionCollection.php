<?php namespace Purplapp\Adn;

use stdClass;

class MentionCollection extends Collection
{
    protected function transform(stdClass $object)
    {
        return Mention::wrap($object);
    }
}
