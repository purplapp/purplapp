<?php namespace Purplapp\Tests;

class AccountPageForGuestTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_shows_a_signin_invitation_to_guests()
    {
        $this->call("GET", "/account");

        $this->assertResponseOk();
        $this->assertRegExpExists('/Want to use any of these\? Hit "Sign in" above and get started/');
        $this->assertLinkExists("Sign in");
    }

    /**
     * @test
     */
    public function it_doesnt_show_tool_links_to_guests()
    {
        $this->call("GET", "/account");

        $this->assertResponseOk();
        $this->assertNoLinkExists("User Lookup Tool");
        $this->assertNoLinkExists("First Mention Tool");
        $this->assertNoLinkExists("Following Comparison Tool");
    }
}
