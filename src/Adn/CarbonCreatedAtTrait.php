<?php namespace Purplapp\Adn;

use Carbon\Carbon;

trait CarbonCreatedAtTrait
{
    public function createdAt()
    {
        return Carbon::createFromFormat("Y-m-d\TH:i:s\Z", $this->created_at);
    }
}
