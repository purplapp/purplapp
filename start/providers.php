<?php // providers.php


date_default_timezone_set('UTC');

use Silex\Provider\TwigServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Purplapp\Adn\NiceRankAwareClient;

use GuzzleHttp\Client as GuzzleClient;

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new TwigServiceProvider(), [
    "twig.path" => app_dir() . "/out/views",
    "twig.options" => [
        "debug" => true,
        "cache" => app_dir() . "/cache",
    ],
]);

$app->register(new Silex\Provider\SessionServiceProvider(), [
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
