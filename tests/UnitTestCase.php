<?php namespace Purplapp\Tests;

use PHPUnit_Framework_TestCase as BaseCase;
use Purplapp\Adn\User;

abstract class UnitTestCase extends BaseCase
{
    protected function mockUser(array $details = [])
    {
        $attributes = $details + [
            "id" => 2,
            "counts" => (object) [
                "posts" => 0,
            ],
            "description" => (object) [
                "text" => "lorem ipsum",
                "entities" => (object) [

                ],
            ],
        ];

        return User::wrap($attributes);
    }
}
