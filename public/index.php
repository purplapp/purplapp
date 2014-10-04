<?php

// wrap it in a while so break has a meaning
while (php_sapi_name() === "cli-server") {
    $filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER["REQUEST_URI"]);

    // just run normally if the file requested is PHP (i.e. don't serve it)
    if (pathinfo($filename, PATHINFO_EXTENSION) === "php") {
        break;
    }

    // just run normally if the requested file doesn't exist
    if (!is_file($filename)) {
        break;
    }

    // if the file does exist and is NOT a php file, serve that
    return false;
}

$app = require __DIR__ . "/../bootstrap.php";

$app->run();
