<?php namespace Purplapp\Adn;

use Carbon\Carbon;

trait TimeSinceCreatedTrait
{
    use CarbonCreatedAtTrait;

    private $timeSinceCreated;

    public function timeSinceCreated()
    {
        if (!$this->timeSinceCreated) {
            $this->timeSinceCreated = $this->createdAt()->diff(Carbon::now());
        }

        return $this->timeSinceCreated;
    }
}
