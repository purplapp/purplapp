<?php namespace Purplapp\Adn;

/**
 * Implements the Countable interface by proxy
 */
trait CountableTrait
{
    /**
     * @param $mode int
     *
     * @return int
     */
    public function count($mode = COUNT_NORMAL)
    {
        return count($this->data());
    }
}
