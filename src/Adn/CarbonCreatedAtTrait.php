<?php namespace Purplapp\Adn;

use Carbon\Carbon;

/**
 * Adds a helper "createdAt" method that returns a Carbon object when
 * requesting createdAt() instead of the ISO date string that comes with
 * created_at
 */
trait CarbonCreatedAtTrait
{
    /**
     * @return \Carbon\Carbon
     */
    public function createdAt()
    {
        return Carbon::createFromFormat("Y-m-d\TH:i:s\Z", $this->created_at, "UTC");
    }
}
