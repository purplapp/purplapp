<?php namespace Purplapp\Adn;

use stdClass;

class PostCollection extends Collection
{
    protected function transform(stdClass $object)
    {
        return Post::wrap($object);
    }
}
