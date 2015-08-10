<?php namespace Purplapp\Tests;

class AboutPageTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_describes_the_site()
    {
        $this->call("GET", "/about");

        $this->assertResponseOk();
        $this->assertElementExists("h1:contains('About Purplapp')");
        $this->assertRegExpExists("/Dribbble/", "/iOS/", "/concept/", "/Email/", "/GitHub/");
    }

    /**
     * @test
     */
    public function it_credits_the_team_member()
    {
        $this->call("GET", "/about");

        $this->assertElementExists('h2:contains("Team")');

        $this->assertRegExpExists(
            "/Charlotte/",
            "/Johannes/",
            "/Ciaran/",
            "/Hugo/",
            "/Brandon/",
            "/Jessica Dennis/"
        );
    }

    /**
     * @test
     */
    public function it_credits_the_awesome_oss_libs_were_using()
    {
        $this->call("GET", "/about");

        $this->assertRegExpExists(
            "/Font Awesome/", "/Dave Gandy/", "/fontawesome\.io/",
            "/Glyphicon Halflings/", "/glyphicons.com/"
        );
    }

    /**
     * @test
     */
    public function it_shows_each_contributors_handle()
    {
        $alpha = function ($handle) {
            return "https://alpha.app.net/{$handle}";
        };

        $twitter = function ($handle) {
            return "https://twitter.com/{$handle}";
        };

        $contributors = [
            ["purplapp", $alpha],
            ["ciarand", $alpha],
            ["jvimedia", $alpha],
            ["hu", $alpha],
            ["remus", $alpha],
            ["jessicadennis", $alpha],
        ];

        $this->call("GET", "/about");

        foreach ($contributors as $contrib) {
            list($handle, $urlgen) = $contrib;

            $this->assertLinkExists("@{$handle}", $urlgen($handle));
        }
    }
}
