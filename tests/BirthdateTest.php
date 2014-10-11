<?php namespace Purplapp\Tests;

use Carbon\Carbon;

class BirthdateTest extends UnitTestCase
{
    /**
     * @test
     */
    public function it_should_correctly_format_a_birthdate_with_no_year()
    {
        $birthdate = $this->mockBirthdate("XXXX-10-06");

        $this->assertEquals("10-06", $birthdate->format("m-d"));
    }

    /**
     * @test
     */
    public function it_should_support_the_has_year_query()
    {
        $birthdateWithYear = $this->mockBirthdate("1983-10-06");
        $birthdateWithoutYear = $this->mockBirthdate("XXXX-10-06");

        $this->assertTrue($birthdateWithYear->hasYear());
        $this->assertFalse($birthdateWithoutYear->hasYear());
    }

    /**
     * @test
     */
    public function it_should_correctly_format_a_birthdate_including_a_year()
    {
        $birthdate = $this->mockBirthdate("2001-01-03");

        $this->assertEquals("03-01-2001", $birthdate->format("d-m-Y"));
    }

    private function mockBirthdate($date)
    {
        return $this->mockUser([
            "annotations" => [
                (object) [
                    "type" => "com.appnetizens.userinput.birthday",
                    "value" => (object) [
                        "birthday" => $date,
                    ],
                ],
            ],
        ])->birthdate();
    }
}
