<?php namespace Purplapp\Adn;

use Iterator;
use Countable;

class Collection implements Iterator, Countable
{
    use DataCollectionTrait;
}
