<?php namespace Purplapp\Adn;

class Cache
{
    private $data = [];

    public function has($key)
    {
        return isset($this->data[$key]);
    }

    public function put($key, $value)
    {
        return $this->data[$key] = $value;
    }

    public function get($key, $default = null)
    {
        if ($this->has($key)) {
            return $this->data[$key];
        }

        if (is_callable($default)) {
            return $this->data[$key] = $default();
        }

        return $this->data[$key] = $default;
    }

}
