<?php namespace Purplapp\Tests;

use Silex\WebTestCase as SilexWebTestCase;

abstract class WebTestCase extends SilexWebTestCase
{
    protected $app;

    protected $client;

    public function setUp()
    {
        $this->app = $this->createApplication();

        $this->client = $this->createClient();
    }

    public function createApplication()
    {
        $app = require __DIR__ . "/../bootstrap.php";

        $app["session.test"] = true;

        return $app;
    }

    public function call(
        $method,
        $uri,
        $params = [],
        $files = [],
        $server = [],
        $content = null,
        $changeHistory = true
    ) {
        $this->crawler = call_user_func_array([$this->client, "request"], func_get_args());

        return $this->client->getResponse();
    }

    /**
     * Assert that the client response has an OK status code.
     *
     * @return void
     */
    public function assertResponseOk()
    {
        $response = $this->client->getResponse();

        $actual = $response->getStatusCode();

        return $this->assertTrue($response->isOk(), 'Expected status code 200, got ' .$actual);
    }

    /**
     * Assert that the client response has a given code.
     *
     * @param  int  $code
     * @return void
     */
    public function assertResponseStatus($code)
    {
        return $this->assertEquals($code, $this->client->getResponse()->getStatusCode());
    }

    /**
     * Assert that the response view has a given piece of bound data.
     *
     * @param  string|array  $key
     * @param  mixed  $value
     * @return void
     */
    public function assertViewHas($key, $value = null)
    {
        if (is_array($key)) {
            return $this->assertViewHasAll($key);
        }

        $response = $this->client->getResponse();

        if (!isset($response->original) || !$response->original instanceof View) {
            return $this->assertTrue(false, 'The response was not a view.');
        }

        if (is_null($value)) {
            $this->assertArrayHasKey($key, $response->original->getData());
        } else {
            $this->assertEquals($value, $response->original->$key);
        }
    }

    /**
     * Assert whether the client was redirected to a given URI.
     *
     * @param  string  $uri
     * @param  array   $with
     * @return void
     */
    public function assertRedirectedTo($uri, $with = array())
    {
        $response = $this->client->getResponse();

        $this->assertInstanceOf('Illuminate\Http\RedirectResponse', $response);

        $this->assertEquals($this->app['url']->to($uri), $response->headers->get('Location'));

        $this->assertSessionHasAll($with);
    }

    /**
     * Assert whether the client was redirected to a given route.
     *
     * @param  string  $name
     * @param  array   $parameters
     * @param  array   $with
     * @return void
     */
    public function assertRedirectedToRoute($name, $parameters = array(), $with = array())
    {
        $this->assertRedirectedTo($this->app['url']->route($name, $parameters), $with);
    }

    /**
     * Assert whether the client was redirected to a given action.
     *
     * @param  string  $name
     * @param  array   $parameters
     * @param  array   $with
     * @return void
     */
    public function assertRedirectedToAction($name, $parameters = array(), $with = array())
    {
        $this->assertRedirectedTo($this->app['url']->action($name, $parameters), $with);
    }

    public function assertElementExists($element)
    {
        $this->assertGreaterThan(
            0, $this->crawler->filter($element)->count(),
            "No nodes that match '{$element}' were found"
        );
    }

    public function assertLinkExists($linkText, $href = null)
    {
        $nodes = $this->crawler->selectLink($linkText);

        $this->assertGreaterThan(0, $nodes->count(),
            "No links labelled {$linkText} were found");

        if ($href) {
            $nodes->each(function ($link) use ($href) {
                $this->assertLinksEqual($href, $link->attr("href"));
            });
        }
    }

    public function assertNoLinkExists($linkText, $href = null)
    {
        $links = $this->crawler->selectLink($linkText);

        if ($href) {
            $links->filter("[href^={$href}]");
        }

        $this->assertEquals(0, $links->count());
    }

    public function assertRegExpExists()
    {
        foreach (func_get_args() as $regex) {
            $this->assertRegExp($regex, $this->client->getResponse()->getContent());
        }
    }

    public function click($link)
    {
        $this->crawler = $this->client->click($link);
    }

    public function filter($filter, $replace = false)
    {
        $new = $this->crawler->filter($filter);

        if ($replace) {
            $this->crawler = $new;
        }

        return $new;
    }

    private function assertLinksEqual($expected, $actual)
    {
        $expectedParts = parse_url($expected);
        $actualParts   = parse_url($actual);

        // only iterates through the parts of the URL that are provided,
        // meaning you can leave off parts like the scheme and it'll still get
        // what you mean
        foreach ($expectedParts as $key => $value) {
            $this->assertEquals($value, $actualParts[$key]);
        }
    }
}
