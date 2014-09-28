<?php namespace Purplapp\Adn;

class PostCollection
{
    use JsonCollectionTrait;

    protected function transform(stdObject $object)
    {
        return Post::wrap($object);
    }
}
