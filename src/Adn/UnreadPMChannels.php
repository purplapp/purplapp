<?php namespace Purplapp\Adn;

use stdClass;
use Countable;

class UnreadPMChannels 
{
	use DataContainerTrait;

	public function count()
	{
	  return ((int) $this->data);
	}
}
