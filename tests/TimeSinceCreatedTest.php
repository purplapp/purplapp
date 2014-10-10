<?php namespace Purplapp\Tests;

use Purplapp\Adn\TimeSinceCreatedTrait;
use Carbon\Carbon;

class TimeSinceCreatedTestCase extends UnitTestCase
{
    /**
     * @test
     */
    public function is_should_replace_before_with_ago()
    {
        $x = new DummyTimeSinceCreated("2014-10-23T12:03:02Z");

        Carbon::setTestNow(Carbon::create(2014, 10, 25, 12, 00, 00));

        $this->assertStringEndsWith("ago", $x->humanFriendlyTimeSinceCreated());
    }
}

class DummyTimeSinceCreated
{
    use TimeSinceCreatedTrait; // make sure to import it via a “use” statement at the top of the file
 
    protected $created_at;
    
    public function __construct($time)
    {
        $this->created_at = $time;
    }
}