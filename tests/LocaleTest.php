<?php namespace Purplapp\Tests;

class LocaleTest extends UnitTestCase
{
    /**
     * @test
     */
    public function it_should_convert_correct_locale()
    {
        $locale = new \Purplapp\Adn\Locale("en_US");

        $this->assertEquals("English (United States)", $locale);
    }

    /**
     * @test
     */
    public function it_should_error_correct_locale()
    {
        $locale = new \Purplapp\Adn\Locale("oh_MY");

        $this->assertEquals("Unknown Locale", $locale);
    }
}
