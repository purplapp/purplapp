<?php namespace Purplapp\Adn;

use stdClass;

trait DataCollectionTrait
{
    use DataContainerTrait;

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
