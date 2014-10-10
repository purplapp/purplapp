<?php namespace Purplapp\Tests;

use Purplapp\Adn\PostClubs;
use Purplapp\Adn\User;

class PostsClubTest extends UnitTestCase
{
    /**
     * @test
     */
    public function it_should_show_0_clubs_for_a_user_with_no_posts()
    {
        $clubs = $this->mockUserWithCountAndId(0, 200)->clubs();

        $this->assertCount(0, $clubs->memberClubs());
    }

    /**
     * @test
     */
    public function it_should_show_the_mystery_science_club_to_users_with_3000_posts()
    {
        $clubs = $this->mockUserWithCountAndId(3000, 2)->clubs();

        $this->assertContainsClub("MysteryScienceClub", $clubs->memberClubs());
        $this->assertNotContainsClub("MysteryScienceClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_not_show_the_spinal_tap_to_a_level_0_noob()
    {
        $clubs = $this->mockUserWithCountAndId(0, 34555)->clubs();

        $this->assertNotContainsClub("SpinalTapClub", $clubs->memberClubs());
        $this->assertContainsClub("SpinalTapClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_not_show_the_orphan_black_club_if_the_user_hasnt_earned_it()
    {
        $clubs = $this->mockUserWithCountAndId(4000, 4500)->clubs();

        $this->assertNotContainsClub("OrphanBlackClub", $clubs->memberClubs());
        $this->assertContainsClub("OrphanBlackClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_show_the_orphan_black_club_if_the_user_has_earned_it()
    {
        $clubs = $this->mockUserWithCountAndId(20000, 2)->clubs();

        $this->assertContainsClub("OrphanBlackClub", $clubs->memberClubs());
        $this->assertNotContainsClub("OrphanBlackClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_show_clubs_in_order()
    {
        $clubs = $this->mockUserWithCountAndId(50000, 46000);

        $count = count($clubs);

        for ($i = 1; $i < $count; $i += 1) {
            if ($clubs[$i - 1]["count"] > $clubs[$i]["count"]) {
                $this->assertLessThanOrEqualTo($clubs[$i]["count"], $clubs[$i - 1]["count"]);
            }
        }
    }

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

    private function mockUserWithCountAndId($count, $identifier = 2)
    {
        return $this->mockUser(
            [
                "id" => $identifier,
                "counts" => (object) ["posts" => $count]
            ]
        );
    }

    private function assertContainsClub($clubName, $clubs)
    {
        $hasClub = false;
        foreach ($clubs as $club) {
            if ($club->url === $clubName) {
                $hasClub = true;
            }
        }

        $this->assertEquals($hasClub, true, "User was not given the {$clubName}");
    }

    private function assertNotContainsClub($clubName, $clubs)
    {
        foreach ($clubs as $club) {
            $this->assertNotEquals($club->url, $clubName);
        }
    }
}
