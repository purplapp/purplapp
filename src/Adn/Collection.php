<?php namespace Purplapp\Adn;

use Iterator;
use Countable;

abstract class Collection implements Iterator, Countable
{
    use DataContainerTrait;
    use IteratorTrait;
    use CountableTrait;
    use FunctionalCollectionTrait;

    /**
     * Returns the last element in the collection
     *
     * @return mixed
     */
    public function tail()
    {
        return $this->transformIfNotNull(end($this->data) ?: null);
    }

    /**
     * Returns the first element in the collection
     *
     * @return mixed
     */
    public function head()
    {
        return $this->transformIfNotNull(reset($this->data) ?: null);
    }

    /**
     * Sorts the collection
     */
    public function sort()
    {
        return sort($this->data);
    }

    /**
     * Converts the collection into an array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Returns a copy of the data
     *
     * @return array
     */
    protected function data()
    {
        return $this->data;
    }

    /**
     * Transforms an object as its being pulled out of the container. Meant to
     * be overriden in a child class.
     *
     * @param $object stdClass
     *
     * @return mixed
     */
    protected function transform(stdClass $object)
    {
        return $object;
    }

    /**
     * Runs an object through the transform function iff it's not null
     *
     * @param $object mixed
     *
     * @return mixed
     */
    private function transformIfNotNull(stdClass $object = null)
    {
        return $object ? $this->transform($object) : $object;
    }
}
