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
})->bind("signout");

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
})->bind("account_mention");

$app->get("/account/user/{username}", function () use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    $client = $app["adn.client"];

    $user = $client->getAuthorizedUser(["include_user_annotations" => true]);

    $firstPost = $client->getAuthorizedUserPosts(
        ["count" => -1, "include_deleted" => false]
    )->head();
    $lastPost = $client->getAuthorizedUserPosts(
        ["count" => 1, "include_deleted" => false]
    )->tail();

    $firstMention = $client->getAuthorizedUserMentions(
        ["count" => -1, "include_deleted" => false]
    )->head();
    $lastMention = $client->getAuthorizedUserMentions(
        ["count" => 1, "include_deleted" => false]
    )->tail();

    $niceRank = $client->getAuthorizedUserNiceRank()->head();

    return $app->render("account_user.twig", [
        "user"          => $user,
        "first_post"    => $firstPost,
        "last_post"     => $lastPost,
        "first_mention" => $firstMention,
        "last_mention"  => $lastMention,
        "nice_rank"     => $niceRank,
    ]);

})->bind("account_user")->value("username", "me");

$app->get("/account/follow_comparison", function () use ($app) {
    return $app->render("account_follow_comparison.twig");
})->bind("account_follow_comparison");
