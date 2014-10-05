<?php namespace Purplapp\Tests;

class IndexPageTest extends WebTestCase
{
    /**
     * @test
     */
    public function it_should_have_a_welcoming_front_page()
    {
        $this->call("GET", "/");

        $this->assertResponseOk();
        $this->assertElementExists('h1:contains("Welcome!")');
    }

    /**
     * @test
     */
    public function it_should_have_a_link_to_our_github_repo()
    {
        $this->call("GET", "/");

        $this->assertLinkExists("GitHub", "https://github.com/purplapp");
    }

    /**
     * @test
     */
    public function it_should_list_all_our_account_features()
    {
        $this->call("GET", "/");

        $this->assertElementExists('h2:contains("Account Features")');
        $this->assertRegExpExists(
            "/Find details on your account/",
            "/Find the first mentions/",
            "/Compare your followers with that/",
            "/See the most recent 5 updates/"
        );
    }
}
