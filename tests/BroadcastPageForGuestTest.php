<?php namespace Purplapp\Tests;

class BroadcastPageForGuestTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_should_show_tools_for_broadcasts_channels_in_the_title()
    {
        $this->call("GET", "/broadcast");

        $this->assertResponseOk();
        $this->assertElementExists('h1:contains("Tools for Broadcast Channels")');
        $this->assertElementExists('title:contains("Broadcast Tools")');
    }

    /**
     * @test
     */
    public function it_should_show_a_guest_signin_page()
    {
        $this->call("GET", "/broadcast");

        $this->click($this->filter('a:contains("Learn more")')->eq(0)->link());
        $this->assertLinkExists(
            "Sign in with App.net",
            "https://account.app.net/oauth/authenticate"
        );

        $this->assertRegExpExists("/we do not send Broadcast messages for you/");
    }
}
