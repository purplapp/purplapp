<?php

use Purplapp\Application;

function app_dir()
{
    return __DIR__;
}

require app_dir() . "/vendor/autoload.php";

$app = new Application();

require app_dir() . "/start/init.php";
require app_dir() . "/start/providers.php";
require app_dir() . "/start/routes.php";

return $app;
