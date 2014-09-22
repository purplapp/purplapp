<?php // init.php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\HttpFoundation\Response;

ErrorHandler::register();

Dotenv::load(app_dir());
Dotenv::required([
    'CLIENT_ID',
    'CLIENT_SECRET',
    'ALPHA_DOMAIN',
    'SUPPORT_EMAIL',
    'GITHUB_URL'
]);

$app["debug"] = true;

$app->error(function (Exception $e, $code) use ($app) {
    if ($app["debug"]) {
        return;
    }

    return new Response("uh oh");
});
