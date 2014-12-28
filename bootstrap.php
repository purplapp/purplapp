<?php

use Purplapp\Application;

defined("APP_DIR") || define("APP_DIR", __DIR__);

if (!function_exists("app_dir")) {
    function app_dir()
    {
        return APP_DIR;
    }
}

if (!function_exists("storage_dir")) {
    function storage_dir()
    {
        return APP_DIR . "/storage";
    }
}

require app_dir() . "/vendor/autoload.php";

$app = new Application();

require app_dir() . "/start/init.php";
require app_dir() . "/start/providers.php";
require app_dir() . "/start/routes.php";

return $app;
