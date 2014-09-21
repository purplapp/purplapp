<?php

function twig()
{
    // for now
    $app = sess();

    $loader = new Twig_Loader_Filesystem(app_dir() . "/views");

    $twig = new Twig_Environment(
        $loader,
        array('debug' => true, 'cache' => app_dir() . "/cache", "strict_variables" => true)
    );

    $isGuestFunc = new Twig_SimpleFunction("is_guest", function () use ($app) {
        return !$app->getSession();
    });

    $getUserHandleFunc = new Twig_SimpleFunction("user_handle", function () use ($app) {
        $data = $app->getUser();

        return isset($data["username"]) ? $data["username"] : null;
    });

    $alphaDomain = new Twig_SimpleFunction("alpha_domain", function () {
        return getenv("ALPHA_DOMAIN");
    });

    $hostName = new Twig_SimpleFilter("host_name", function ($url) {
        return parse_url($url, PHP_URL_HOST);
    });

    $twig->addFunction($isGuestFunc);
    $twig->addFunction($getUserHandleFunc);
    $twig->addFunction($alphaDomain);

    $twig->addFilter($hostName);

    $twig->addExtension(new Twig_Extension_Debug());

    return $twig;
}
