<?php require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Finder\Finder;
use \Robo\Tasks as TaskList;
use \Robo\Task\GenMarkdownDocTask as Doc;

class RoboFile extends TaskList
{
    const SECONDS = 1000000;

    const SERVER_PORT = 8083;

    /**
     * @desc Start the built-in PHP web server
     */
    public function serve()
    {
        $this->say("Starting the built-in server on localhost:" . self::SERVER_PORT);

        return $this->getServer()->run();
    }

    /**
     * @desc Starts gulp
     */
    public function gulp($args = "")
    {
        $this->say("Starting the gulp process");

        $this->taskExec("./node_modules/.bin/gulp")->args($args)->run();
    }

    /**
     * @desc Runs the test suite
     */
    public function test($args = "")
    {
        return $this->taskExec("./bin/phpunit")->args($args)->run();
    }

    /**
     * @desc watches the directory and reruns the tests when something is
     * changed
     */
    public function tdd($args = "")
    {
        $this->getServer()->background()->run();

        $this->test($args);

        $self    = $this;
        $files   = __DIR__ . "/tests/";

        return $this->taskWatch()
            ->monitor($files, function ($event) use ($args, $self) {
                $path = (string) $event->getResource()->getResource();
                $ext  = pathinfo($path, PATHINFO_EXTENSION);

                if (!in_array($ext, ["php", "twig", "json"])) {
                    return;
                }

                return $self->test($args);
            })
            ->run();
    }

    public function tags()
    {
        return $this->taskExec("phptags")->run();
    }

    private function getServer()
    {
        return $this->taskServer(self::SERVER_PORT)
            ->dir(__DIR__ . "/public")
            ->arg(__DIR__ . "/public/index.php");
    }
}
