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

$app["debug"] = false;

$app->error(function (Exception $e, $code) use ($app) {
    if ($app["debug"]) {
        return;
    }

    switch ($code) {
        case 404:
            $message = 'The requested page could not be found. <br> Please refresh the page and try again, or return to the previous page.';
            break;
        default:
            $message = 'We are sorry, but something went terribly wrong. <br> Unfortunately we cannot continue: so please refresh the page and try again, or return to the previous page.';
    }

    return new Response($message);
});
