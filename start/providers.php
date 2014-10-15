<?php // providers.php

date_default_timezone_set('UTC');

use Purplapp\Adn\NiceRankAwareClient;

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;

use SilexAssetic\AsseticServiceProvider;

use Assetic\Extension\Twig\AsseticExtension;
use Assetic\Filter\CssMinFilter;
use Assetic\Filter\GoogleClosure\CompilerApiFilter;
use Assetic\Asset\AssetCollection;
use Assetic\Asset\AssetCache;
use Assetic\Asset\GlobAsset;
use Assetic\Asset\FileAsset;
use Assetic\Cache\FilesystemCache;

use GuzzleHttp\Client as GuzzleClient;

use \Github\Client as GithubClient;

$app->register(new UrlGeneratorServiceProvider());

$app->register(new TwigServiceProvider(), [
    "twig.path" => app_dir() . "/views",
    "twig.options" => [
        "debug" => $app["debug"],
        "cache" => app_dir() . "/cache/twig",
    ],
]);

$app->register(new AsseticServiceProvider());
$app["assetic.options"] = ["debug" => $app["debug"]];
$app['assetic.path_to_web'] = APP_DIR . "/public";

$app->register(new SessionServiceProvider(), [
    "session.storage.options" => [
        "name" => "purlpapp_sess",
        "cookie_lifetime" => 60 * 60 * 24 * 7,
    ],
]);

$app->register(new MonologServiceProvider(), [
    "monolog.logfile" => app_dir() . "/logs/" . date("Y-m-d") . ".log",
]);

$app["twig"] = $app->share($app->extend("twig", function ($twig, $app) {
    $twig->addGlobal("alpha_domain", getenv("ALPHA_DOMAIN"));
    $twig->addGlobal("support_email", getenv("SUPPORT_EMAIL"));
    $twig->addGlobal("github_url", getenv("GITHUB_URL"));

    $twig->addGlobal("auth_url", $app["adn.auth_url"]);
    $twig->addGlobal("user", $app["adn.user"]);

    $twig->addFilter(new Twig_SimpleFilter("host_name", function ($url) {
        return parse_url($url, PHP_URL_HOST);
    }));

    $twig->addFunction(new Twig_SimpleFunction("user_handle", function () use ($app) {
        return $app["session"]->get("user")->username;
    }));

    $twig->addFunction(new Twig_SimpleFunction("is_guest", function () use ($app) {
        return $app["session"]->get("user") === null;
    }));

    $twig->addExtension(new Twig_Extension_Debug());

    $twig->addExtension(new AsseticExtension($app["assetic.factory"]));

    return $twig;
}));

$app["http.host"] = function () {
    if (isset($app["request"])) {
        return $app["request"]->getHttpHost();
    } else if (isset($_SERVER["HTTP_HOST"])) {
        return $_SERVER["HTTP_HOST"];
    } else {
        return "localhost";
    }
};

$app["adn.settings"] = [
    "CLIENT_ID"     => getenv("CLIENT_ID"),
    "CLIENT_SECRET" => getenv("CLIENT_SECRET"),
    "ALPHA_DOMAIN"  => getenv("ALPHA_DOMAIN"),
    "SUPPORT_EMAIL" => getenv("SUPPORT_EMAIL"),
    "GITHUB_URL"    => getenv("GITHUB_URL"),
    "REDIRECT_URL"  => "http://{$app["http.host"]}/adn/callback",
    "GITHUB_TOKEN"  => getenv("GITHUB_TOKEN"),
    "API_SCOPE"     => [
        "basic",
        "follow",
        "public_messages",
        "messages",
    ],
];

$app["adn.auth_url"] = function () use ($app) {
    $settings = $app["adn.settings"];

    return $app["adn.client"]->getAuthUrl($settings["REDIRECT_URL"], $settings["API_SCOPE"]);
};

$app["adn.user"] = function () use ($app) {
    return $app["session"]->get("user");
};

$app["adn.access_token"] = function () use ($app) {
    return $app["session"]->get("access_token");
};

$app["adn.client"] = function () use ($app) {
    $settings = $app["adn.settings"];

    return new NiceRankAwareClient(
        $settings["CLIENT_ID"],
        $settings["CLIENT_SECRET"],
        $settings["REDIRECT_URL"],
        $app["monolog"],
        new GuzzleClient(),
        $app["session"]->get("access_token")
    );
};

$app["assetic.filter_manager"] = $app->share(
    $app->extend('assetic.filter_manager', function($fm, $app) {
        $fm->set("jsmin", new CompilerApiFilter());

        return $fm;
    })
);

$app['assetic.asset_manager'] = $app->share(
    $app->extend('assetic.asset_manager', function($am, $app) {
        $vendor = function ($path) {
            return new FileAsset(APP_DIR . "/assets/{$path}");
        };

        $asset = function ($path) {
            return new FileAsset(APP_DIR . "/public/{$path}");
        };

        $styles = new AssetCollection([
            $vendor("bootstrap/dist/css/bootstrap.min.css"),
            $vendor("font-awesome/css/font-awesome.min.css"),
            $vendor("bootstrap-social/bootstrap-social.css"),
            $vendor("octicons/octicons/octicons.css"),
            $asset("css/mod.css"),
            $asset("css/opensource.css"),
        ]);

        $scripts = new AssetCollection([
            $vendor("jquery/dist/jquery.min.js"),
            $vendor("bootstrap/dist/js/bootstrap.min.js"),
            $vendor("chartjs/Chart.min.js"),
        ], [
            $app["assetic.filter_manager"]->get("jsmin")
        ]);

        $cache = new FilesystemCache(APP_DIR . '/cache/assetic');

        $am->set('styles', new AssetCache($styles, $cache));
        $am->get('styles')->setTargetPath('css/style.min.css');

        $am->set("scripts", new AssetCache($scripts, $cache));
        $am->get('scripts')->setTargetPath('js/app.min.js');

        return $am;
    })
);

