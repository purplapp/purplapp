<?php namespace Purplapp\Adn;

trait JsonCollectionTrait
{
    use JsonObjectTrait;

    public function tail()
    {
        return end($this->data);
    }

    public function head()
    {
        return reset($this->data);
    }

    protected function transform(stdObject $object)
    {
        return $object;
    }
}
