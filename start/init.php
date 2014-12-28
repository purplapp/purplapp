<?php // init.php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\HttpFoundation\Response;
use Whoops\Provider\Silex\WhoopsServiceProvider;

if (date_default_timezone_get() === "") {
    date_default_timezone_set('UTC');
}

ErrorHandler::register();

Dotenv::load(APP_DIR, ".config");

Dotenv::required([
    'CLIENT_ID',
    'CLIENT_SECRET',
    'ALPHA_DOMAIN',
    'SUPPORT_EMAIL',
    'GITHUB_URL',
    'GITHUB_TOKEN',
    'DEBUG',
]);

$app["debug"] = getenv("DEBUG");

if ($app["debug"]) {
    $app->register(new WhoopsServiceProvider());
}

$app->error(function (Exception $e, $code) use ($app) {
    if ($app['debug']) {
        // Whoops'll get it
        return;
    }

    if ($code === 404) {
        $view = "404.twig";
    } else if (400 >= $code && $code < 500) {
        $view = "4xx.twig";
    } else if (500 >= $code && $code < 600) {
        $view = "5xx.twig";
    } else {
        $view = "error.twig";
    }

    $data = ["code" => $code, "message" => $e->getMessage()];
    return $app->render($view, $data);
});
