<?php namespace Purplapp\Tests;

class ByteUnitTest extends WebTestCase
{
    /**
     * @test
     */
    public function should_convert_bytes_into_human_readable_figures()
    {
        $twig = $this->app["twig"];

        $loader = new \Twig_Loader_Array(array(
            'test_file.twig' => '{{ human_bytes(1024, 0) }}',
        ));

        $twig->setLoader($loader);

        $this->assertEquals("1kB", $twig->render("test_file.twig"));
    }
}
