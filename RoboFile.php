<?php require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Finder\Finder;
use Robo\Tasks as TaskList;
use Robo\Task\GenMarkdownDocTask as Doc;
use Assetic\AssetWriter;
use Assetic\Extension\Twig\TwigFormulaLoader;
use Assetic\Extension\Twig\TwigResource;
use Assetic\Factory\LazyAssetManager;

class RoboFile extends TaskList
{
    const SECONDS = 1000000;

    const SERVER_PORT = 8083;

    public static $assets = [
        [
            "url" => "https://github.com/github/octicons.git",
            "component" => "octicons",
            "version" => "v2.1.2",
        ],
        [
            "url" => "https://github.com/FortAwesome/Font-Awesome.git",
            "component" => "font-awesome",
            "version" => "v4.2.0",
        ],
        [
            "url" => "https://github.com/twbs/bootstrap.git",
            "component" => "bootstrap",
            "version" => "v3.2.0",
        ],
        [
            "url" => "https://github.com/jquery/jquery.git",
            "component" => "jquery",
            "version" => "2.1.1",
        ],
        [
            "url" => "https://github.com/nnnick/Chart.js.git",
            "component" => "chartjs",
            "version" => "v1.0.1-beta.4",
        ],
        [
            "url" => "https://github.com/lipis/bootstrap-social.git",
            "component" => "bootstrap-social",
            "version" => "4.8.0",
        ]
    ];

    public static $fontDirectories = [
        "/assets/font-awesome/fonts/",
        "/assets/bootstrap/fonts/",
        "/assets/bootstrap-social/assets/fonts/",
        "/assets/octicons/octicons/",
    ];

    /**
     * @desc Start the built-in PHP web server
     */
    public function serve()
    {
        $this->say("Starting the built-in server on localhost:" . self::SERVER_PORT);

        return $this->getServer()->run();
    }

    /**
     * @desc Downloads all the front-end assets required
     *
     * NOTE: totally does NOT use bower
     */
    public function bower()
    {
        $this->stopOnFail(true);

        foreach (static::$assets as $asset) {
            $this->downloadAsset($asset["url"], $asset["component"], $asset["version"]);
        }
    }

    private function downloadAsset($url, $component, $version)
    {
        $path = $this->getAssetPath($component);

        if (!file_exists($path)) {
            $this->taskGitStack()
                ->stopOnFail()
                ->cloneRepo($url, $path)
                ->run();
        }

        $this->say("handling asset checkout for {$component}");

        chdir($path);

        $this->taskGitStack()
            ->stopOnFail()
            ->checkout($version)
            ->run();

        chdir(__DIR__);
    }

    private function getAssetPath($name)
    {
        return __DIR__ . "/assets/{$name}";
    }

    /**
     * @desc clears the cache
     */
    public function clean()
    {
        $this->stopOnFail(true);

        $except = [
            "./cache/assetic",
            "./cache/twig",
            "./cache/assetic/.gitignore",
            "./cache/twig/.gitignore",
        ];

        $files = array_diff(
            glob("./cache/{assetic/,twig/,}*", GLOB_BRACE),
            $except
        );

        $this->say(sprintf("Clearing %d cached files", $files));
        $this->taskDeleteDir($files)->run();

        $this->say("Clearing compiled CSS / JS");

        $compiledCss = glob(__DIR__ . "/public/css/style.min*.css");
        $compiledJs  = glob(__DIR__ . "/public/js/app.min*.js");

        $this->taskFileSystemStack()
            ->remove($compiledCss)
            ->remove($compiledJs)
            ->run();
    }

    /**
     * @desc Writes the assets to file
     */
    public function assets()
    {
        $this->stopOnFail(true);

        $app = include __DIR__ . "/bootstrap.php";

        $assetsManager = new LazyAssetManager($app["assetic.factory"]);

        // enable loading assets from twig templates
        $assetsManager->setLoader('twig', new TwigFormulaLoader($app["twig"]));

        // loop through all your templates
        foreach (array_diff(scandir(__DIR__ . "/views"), [".", ".."]) as $template) {
            $resource = new TwigResource($app["twig.loader"], $template);
            $assetsManager->addResource($resource, 'twig');
        }

        $writer = new AssetWriter($app["assetic.path_to_web"]);

        $this->say("Beginning asset dump process. Be patient!");

        $writer->writeManagerAssets($assetsManager);

        $this->say("Copying fonts over");

        foreach (static::$fontDirectories as $dir) {
            $this->taskFileSystemStack()
                ->mirror(APP_DIR . $dir, APP_DIR . "/public/fonts")
                ->run();
        }

    }

    /**
     * @desc Runs the test suite
     */
    public function test($args = "")
    {
        return $this->taskExec("./bin/phpunit")->args($args)->run();
    }

    /**
     * @desc runs the test suite with code coverage turned on
     */
    public function coverage($args = "")
    {
        $this->stopOnFail(true);

        return $this
            ->taskExec("./bin/phpunit")
            ->arg("--coverage-html")
            ->arg("./out/coverage")
            ->args($args)
            ->run();
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

    public function init()
    {
        $this->stopOnFail(true);

        foreach ([__DIR__ . "/logs", __DIR__ . "/cache"] as $dir) {
            $this->taskFileSystemStack()
                // dir, perms, umask, recurse
                ->chmod($dir, 0777, 0000, true)
                // dir, user
                ->chown($dir, "nobody")
                ->run();
        }
    }

    private function getServer()
    {
        return $this->taskServer(self::SERVER_PORT)
            ->dir(__DIR__ . "/public")
            ->arg(__DIR__ . "/public/index.php");
    }
}
