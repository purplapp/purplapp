<?php // routes.php

use Symfony\Component\HttpFoundation\Request;

// helpers
$redirector = function ($name) use ($app) {
    return function () use ($name, $app) {
        return $app->redirect($app->path($name));
    };
};

$renderer = function ($name, array $data = []) use ($app) {
    return function () use ($name, $data, $app) {
        return $app->render($name, $data);
    };
};

/**
 * generates a simple controller that renders templates for GET requests, binds 
 * it to the provided name, and sets up a redirect for legacy URLs that use the 
 * filename.php convention
 *
 * @param string $path
 * @param string $name
 */
$simplePage = function ($path, $name) use ($app, $renderer, $redirector) {
    $app->get($path, $renderer($name . ".twig"))->bind($name);

    if (substr($path, -1) === "/") {
        $path = $path . "/index";
    }

    $app->get($path . ".php", $redirector($name));
};

$simplePage("/", "index");
$simplePage("/account", "account");
$simplePage("/broadcast", "broadcast");
$simplePage("/donate", "donate");
$simplePage("/about", "about");
$simplePage("/legal/privacy", "privacy");
$simplePage("/legal/terms", "terms");

$app->get("/signin", function () use ($app) {
    if ($app["adn.user"]) {
        return $app->redirect($app->path("index"));
    }

    return $app->render("signin.twig");
})->bind("signin");

$app->get("/signout", function () use ($app) {
    $app["session"]->invalidate();

    return $app->redirect($app->path("index"));
});

$app->get("/signin.php", $redirector("signin"));

$app->get("/adn/callback", function (Request $req) use ($app) {
    $response = $app["adn.client"]->getAccessToken($req->get("code"));

    $app["session"]->set("access_token", $response->access_token);
    $app["session"]->set("user", $response->token->user);

    return $app->redirect($app->path("index"));
});

$app->get("/account/mention", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    if (!$req->get("id1") && !$req->get("id2")) {
        return $app->render("user_first_mention_form.twig");
    }

    $left  = $req->get("id1", "me");
    $right = $req->get("id2", "me");
});
