<?php namespace Purplapp\Tests;

use Purplapp\Adn\Client;

class ClientTestCase extends UnitTestCase
{
    /**
     * @test
     */
    public function it_should_normalize_the_string_me_to_me()
    {
        $this->assertEquals("me", $this->normalize("me"));
    }

    /**
     * @test
     */
    public function it_should_prepend_an_at_sign_to_a_username()
    {
        $this->assertEquals("@cmd", $this->normalize("cmd"));
        $this->assertEquals("@cmd", $this->normalize("@cmd"));
    }

    /**
     * @test
     */
    public function it_should_handle_multiple_identifiers()
    {
        $this->assertEquals(
            "@cmd,me,42",
            $this->normalize(["cmd", "me", 42])
        );
    }

    /**
     * @test
     */
    public function it_should_handle_numeric_identifiers_correctly()
    {
        $this->assertEquals("4234", $this->normalize(4234));
        $this->assertEquals("4234", $this->normalize("4234"));
    }

    public function normalize($str)
    {
        return (new TestClient())->normalizeUserIdentifier($str);
    }
}

class TestClient extends Client
{
    public function __construct()
    {
        // no-op
    }

    public function normalizeUserIdentifier($identifier)
    {
        return parent::normalizeUserIdentifier($identifier);
    }
}
