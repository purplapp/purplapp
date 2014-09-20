<?php require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Finder\Finder;
use \Robo\Tasks as TaskList;
use \Robo\Task\GenMarkdownDocTask as Doc;

class RoboFile extends TaskList
{
    const SERVER_PORT = 8000;

    /**
     * @desc Start the built-in PHP web server
     */
    public function serve()
    {
        $this->say("Starting the built-in server on localhost:" . self::SERVER_PORT);

        $this->getServer()->run();
    }

    /**
     * @desc Runs the test suite
     */
    public function test($args = "")
    {
        $this->getServer()->background()->run();

        $this->taskExec("./bin/codecept build")->run();
        $this->taskCodecept('./bin/codecept')
            ->args($args)
            ->run();
    }

    /**
     * @desc watches the directory and reruns the tests when something is 
     * changed
     */
    public function tdd()
    {
        $this->test();

        $self  = $this;
        $files = __DIR__ . "/tests/";

        $this->taskWatch()
            ->monitor($files, function ($event) use ($self) {
                $path                 = (string) $event->getResource()->getResource();
                $extension            = pathinfo($path, PATHINFO_EXTENSION);
                $acceptableExtensions = array("php", "twig", "json");

                if (in_array($extension, $acceptableExtensions)) {
                    $self->test();
                }
            })
            ->run();
    }

    private function getServer()
    {
        return $this->taskServer(self::SERVER_PORT)->dir(__DIR__);
    }
}
