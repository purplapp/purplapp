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
     * @desc Runs the test suite
     */
    public function test($args = "")
    {
        $this->getServer()->background()->run();

        return $this->rebuildAndRunTests($args);
    }

    /**
     * @desc Runs the test suite (for a CI server)
     */
    public function ci()
    {
        $this->getServer()->background()->run();

        sleep(5);

        return (bool) $this->rebuildAndRunTests("--debug");
    }

    /**
     * @desc watches the directory and reruns the tests when something is
     * changed
     */
    public function tdd($args = "")
    {
        $this->getServer()->background()->run();

        $this->rebuildAndRunTests($args);

        $self    = $this;
        $files   = __DIR__ . "/tests/";
        $lastMod = microtime(true);

        return $this->taskWatch()
            ->monitor($files, function ($event) use ($args, $self, $lastMod) {
                $path                 = (string) $event->getResource()->getResource();

                $extension            = pathinfo($path, PATHINFO_EXTENSION);
                $acceptableExtensions = array("php", "twig", "json");

                if (!in_array($extension, $acceptableExtensions)) {
                    return;
                }

                $isTester = preg_match('/\/\w+Tester\.php$/', $path);
                if ($isTester && ($lastMod - microtime(true) > 5000)) {
                    $self->rebuildTesters();
                    $lastMod = microtime(true);
                }

                return $self->getCodecept()->run($args);
            })
            ->run();
    }

    public function tags()
    {
        return $this->taskExec("phptags")->run();
    }

    public function rebuildTesters()
    {
        return $this->taskExec("./bin/codecept build")->run();
    }

    public function getCodecept()
    {
        return $this->taskCodecept('./bin/codecept');
    }

    private function getServer()
    {
        return $this->taskServer(self::SERVER_PORT)
            ->dir(__DIR__ . "/public")
            ->arg(__DIR__ . "/public/index.php");
    }

    private function rebuildAndRunTests($args = "")
    {
        return $this->rebuildTesters() && $this->getCodecept()->args($args)->run();
    }
}
