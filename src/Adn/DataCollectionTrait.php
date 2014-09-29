<?php namespace Purplapp\Adn;

use stdClass;

trait DataCollectionTrait
{
    use DataContainerTrait;

    private $position = 0;

    public function current()
    {
        return $this->data[$this->position];
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
        return isset($this->data[$this->position]);
    }

    public function tail()
    {
        return $this->transform(end($this->data));
    }

    public function head()
    {
        return $this->transform(reset($this->data));
    }

    protected function transform(stdClass $object)
    {
        return $object;
    }
}
