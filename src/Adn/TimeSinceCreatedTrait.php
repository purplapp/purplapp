<?php namespace Purplapp\Adn;

use Carbon\Carbon;

trait TimeSinceCreatedTrait
{
    use CarbonCreatedAtTrait;

    private $timeSinceCreated;

    private $humanFriendlyTimeSinceCreated;

    public function timeSinceCreated()
    {
        if (!$this->timeSinceCreated) {
            $this->timeSinceCreated = $this->createdAt()->diff(Carbon::now());
        }

        return $this->timeSinceCreated;
    }

    public function humanFriendlyTimeSinceCreated()
    {
        if (!$this->humanFriendlyTimeSinceCreated) {
            $this->humanFriendlyTimeSinceCreated = $this->createdAt()->diffForHumans(Carbon::now());
        }

        $this->humanFriendlyTimeSinceCreated = str_replace("before", "ago", $this->humanFriendlyTimeSinceCreated);

        return $this->humanFriendlyTimeSinceCreated;
    }
}
