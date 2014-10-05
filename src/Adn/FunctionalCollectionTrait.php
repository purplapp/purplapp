<?php namespace Purplapp\Adn;

trait FunctionalCollectionTrait
{
    /**
     * Filters the collection using the provided callable as a truth test.
     * Returns a new instance of Collection
     *
     * @param $callable callable
     *
     * @return Collection
     */
    public function filter(callable $callable)
    {
        $clone = $this->data();

        return static::wrap(array_filter($clone, $callable));
    }

    /**
     * Runs the provided callable over each member of the collection, and
     * subsuming the result into a new Collection object
     *
     * @param $callable callable
     *
     * @return Collection
     */
    public function map(callable $callable)
    {
        $clone = $this->data();

        return static::wrap(array_map($callable, $clone));
    }
}
