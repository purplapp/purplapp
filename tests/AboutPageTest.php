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
        $contributors = [
            "purplapp",
            "ciarand",
            "charl",
            "jvimedia",
            "hu",
            "remus",
            "jessicadennis",
        ];

        $this->call("GET", "/about");

        foreach ($contributors as $handle) {
            $this->assertLinkExists("@{$handle}", "https://alpha.app.net/{$handle}");
        }
    }
}
