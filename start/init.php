<?php // init.php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\HttpFoundation\Response;
use Whoops\Provider\Silex\WhoopsServiceProvider;

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
        return;
    }

    $message = $e->getMessage();

    if ($code === 404) {
        return $app->render("404.twig", compact("message", "code"));
    } else if (400 >= $code && $code < 500) {
        return $app->render("4xx.twig", compact("message", "code"));
    } else if (500 >= $code && $code < 600) {
        return $app->render("5xx.twig", compact("message", "code"));
    } else {
        return $app->render("error.twig", compact("message", "code"));
    }
});
