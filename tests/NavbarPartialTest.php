<?php namespace Purplapp\Tests;

class NavbarPartialTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider pagesDataProvider
     */
    public function it_should_test_the_site_titles_are_always_links_home($url)
    {
        $pages = [
            "Tools"   => "/tools",
            "Open Source"   => "/opensource",
            "Donate"          => "/donate",
            "About"           => "/about",
        ];

        $this->call("GET", $url);

        $this->assertLinkExists("Purplapp", "/");

        foreach ($pages as $title => $link) {
            $this->assertLinkExists($title, $link);
        }
    }

    public function pagesDataProvider()
    {
        return [
            "home"      => ["/"],
            "tools"   => ["/tools"],
            "donate"    => ["donate"],
            "about"     => ["about"],
            "signin"    => ["signin"],
            "privacy"   => ["/legal/privacy"],
            "terms"     => ["/legal/terms"],
        ];
    }
}