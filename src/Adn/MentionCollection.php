<?php namespace Purplapp\Adn;

class MentionCollection
{
    use JsonCollectionTrait;

    protected function transform(stdObject $object)
    {
        return Mention::wrap($object);
    }
}
