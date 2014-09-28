<?php namespace Purplapp\Adn;

trait DataContainerTrait
{
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->$key();
        }

        return $this->data->$key;
    }

    public function __isset($key)
    {
        return method_exists($this, $key) || isset($this->data->$key);
    }
}
