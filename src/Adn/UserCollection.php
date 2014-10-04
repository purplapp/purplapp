<?php namespace Purplapp\Adn;

use stdClass;

class UserCollection extends Collection
{
    protected function transform(stdClass $object)
    {
        return User::wrap($object);
    }
}
