<?php namespace Purplapp\Tests;

use Purplapp\Adn\Locale;

class LocaleTest extends UnitTestCase
{
    /**
     * @test
     */
    public function it_should_convert_correct_locale()
    {
        $locale = Locale::fromCode("en_US");

        $this->assertEquals("English (United States)", $locale->name());
    }

    /**
     * @test
     */
    public function it_should_error_correct_locale()
    {
        $locale = Locale::fromCode("foobar");

        $this->assertEquals("Unknown Locale", $locale->name());
    }
}
