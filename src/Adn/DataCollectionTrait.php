<?php namespace Purplapp\Adn;

use stdClass;

trait DataCollectionTrait
{
    use DataContainerTrait;

    private $position = 0;

    public function current()
    {
        return $this->transformIfNotNull($this->data[$this->position] ?: null);
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
        return $this->transformIfNotNull(end($this->data) ?: null);
    }

    public function head()
    {
        return $this->transformIfNotNull(reset($this->data) ?: null);
    }

    public function sort()
    {
        return sort($this->data);
    }

    public function toArray()
    {
        return $this->data;
    }

    public function count($mode = COUNT_NORMAL)
    {
        return count($this->data);
    }

    protected function transform(stdClass $object)
    {
        return $object;
    }

    private function transformIfNotNull(stdClass $object = null)
    {
        return $object ? $this->transform($object) : $object;
    }
}
