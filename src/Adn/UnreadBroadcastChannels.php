<?php namespace Purplapp\Adn;

use stdClass;
use Countable;

class UnreadBroadcastChannels 
{
	use DataContainerTrait;

	public function count()
	{
		return $this->data;
	}
}
