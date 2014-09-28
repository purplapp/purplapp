<?php namespace Purplapp\Adn;

trait CarbonCreatedAtTrait
{
    public function createdAt()
    {
        return Carbon::createFromFormat("Y-m-d\TH:i:s\Z", $this->created_at);
    }
}
