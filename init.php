<?php // init.php

use Symfony\Component\Debug\ErrorHandler;

if (date_default_timezone_get() === "") {
    date_default_timezone_set('UTC');
}

ini_set("expose_php", "Off");

defined("APP_DIR") or define("APP_DIR", __DIR__);
defined("STDERR") or define("STDERR", fopen("php://stderr", "w"));

function app_dir()
{
    return APP_DIR;
}

function storage_dir()
{
    return APP_DIR . "/tmp";
}

require app_dir() . "/vendor/autoload.php";

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
