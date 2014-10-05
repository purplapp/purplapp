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
        $user = $this->mockUserWithCountAndId(0, 200);

        $clubs = PostClubs::forUser($user);

        $this->assertCount(0, $clubs->memberClubs());
    }

    /**
     * @test
     */
    public function it_should_show_the_mystery_science_club_to_users_with_3000_posts()
    {
        $user = $this->mockUserWithCountAndId(3000, 2);

        $clubs = PostClubs::forUser($user);

        $this->assertContainsClub("MysteryScienceClub", $clubs->memberClubs());
        $this->assertNotContainsClub("MysteryScienceClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_not_show_the_spinal_tap_to_a_level_0_noob()
    {
        $clubs = PostClubs::forUser($this->mockUserWithCountAndId(0, 34555));

        $this->assertNotContainsClub("SpinalTapClub", $clubs->memberClubs());
        $this->assertContainsClub("SpinalTapClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_not_show_the_orphan_black_club_if_the_user_hasnt_earned_it()
    {
        $clubs = PostClubs::forUser($this->mockUserWithCountAndId(4000, 4500));

        $this->assertNotContainsClub("OrphanBlackClub", $clubs->memberClubs());
        $this->assertContainsClub("OrphanBlackClub", $clubs->nextClubs());
    }

    /**
     * @test
     */
    public function it_should_show_the_orphan_black_club_if_the_user_has_earned_it()
    {
        $clubs = PostClubs::forUser($this->mockUserWithCountAndId(20000, 2));

        $this->assertContainsClub("OrphanBlackClub", $clubs->memberClubs());
        $this->assertNotContainsClub("OrphanBlackClub", $clubs->nextClubs());
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
