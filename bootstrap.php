<?php

require __DIR__ . "/vendor/autoload.php";

function app_dir()
{
    return __DIR__;
}

function render($view, array $data = array())
{
    $twig = twig();

    return $twig->render($view, $data);
}

Dotenv::load(__DIR__);

Dotenv::required(
    array('CLIENT_ID', 'CLIENT_SECRET', 'ALPHA_DOMAIN', 'SUPPORT_EMAIL', 'GITHUB_URL')
);

