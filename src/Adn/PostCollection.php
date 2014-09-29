<?php namespace Purplapp\Adn;

use stdClass;

class PostCollection
{
    use DataCollectionTrait;

    protected function transform(stdClass $object)
    {
        return Post::wrap($object);
    }
}
