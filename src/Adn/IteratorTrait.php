<?php namespace Purplapp\Adn;

trait IteratorTrait
{
    private $position = 0;

    public function current()
    {
        return $this->transformIfNotNull($this->data()[$this->position] ?: null);
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        $this->position += 1;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->data()[$this->position]);
    }

}
