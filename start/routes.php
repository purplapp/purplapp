<?php // routes.php

ini_set("memory_limit", "256M");    // this is a horrible way to do this and I apologise

use Symfony\Component\HttpFoundation\Request;
use Purplapp\Adn\NumberCollection;

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
$simplePage("/tools", "tools");
$simplePage("/about", "about");
$simplePage("/legal/privacy", "privacy");
$simplePage("/legal/terms", "terms");

$app->get("/signin.php", $redirector("signin"));
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

$app->get("/adn/callback", function (Request $req) use ($app) {
    $response = $app["adn.client"]->getAccessToken($req->get("code"));

    $app["session"]->set("access_token", $response->access_token);
    $app["session"]->set("user", $response->token->user);

    return $app->redirect($app->path("index"));
});

$app->get("/account/mention.php", $redirector("account_mention"));
$app->get("/account/mention", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    if (!$req->get("id1") && !$req->get("id2")) {
        return $app->render("user_first_mention_form.twig");
    }

    $client = $app["adn.client"];

    $left  = $req->get("id1") ?: "me";
    $right = $req->get("id2") ?: "me";

    $leftData  = $client->getUser($left);
    $rightData = $client->getUser($right);

    $leftByRightParams = [
        "mentions"                 => $leftData->username,
        "creator_id"               => $rightData->id,
        "count"                    => -1,
    ];

    $rightByLeftParams = [
        "mentions"                 => $rightData->username,
        "creator_id"               => $leftData->id,
        "count"                    => -1,
    ];

    $rightByLeft = $client->searchPosts($rightByLeftParams)->tail();
    $leftByRight = $client->searchPosts($leftByRightParams)->tail();

    return $app->render(
        "user_first_mention.twig",
        compact("leftData", "rightData", "leftByRight", "rightByLeft")
    );
})->bind("account_mention");

$app->get("/user.php", $redirector("account_user"));
$app->get("/pca.php", $redirector("account_user"));
$app->get("/account/user.php", $redirector("account_user"));
$app->get("/account/user", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    $client = $app["adn.client"];

    if ($req->get("id")) {
        $user = $client->getUser($req->get("id"), ["include_user_annotations" => true]);
    } else {
        $user = $client->getAuthorizedUser(["include_user_annotations" => true]);
    }

    $firstOpts = ["count" => -1, "include_deleted" => false];
    $lastOpts  = ["count" => 1,  "include_deleted" => false];

    $firstPost    = $client->getUserPosts($user, $firstOpts)->head();
    $lastPost     = $client->getUserPosts($user, $lastOpts)->tail();

    $firstMention = $client->getUserMentions($user, $firstOpts)->head();
    $lastMention  = $client->getUserMentions($user, $lastOpts)->tail();

    $niceRank = $client->getUserNiceRank($user)->head();

    $currentUser = $client->getAuthorizedUser();    // set who the current user is

    if ($req->get("id")) {                  // if an ID is being requested as part of the URL
        if ($req->get("id") === $currentUser->username) {   // if the ID being requested is equal to the authorised user's username
            $token = $client->getUserToken();   // get the token
        } else {
            $token = "";    // else there's no token to be set
        }
    } else {
        $token = $client->getUserToken();   // if no user is requested, then it must be the authorised user, hence get the token
    }

    if ($req->get("id")) {
        if ($req->get("id") === $currentUser->username) {
            $unreadBroadcastChannels = $client->getUnreadBroadcastChannels();
            $unreadPMChannels = $client->getUnreadPMChannels();
            $unreadBroadcast = $unreadBroadcastChannels->count();
            $unreadPM = $unreadPMChannels->count();
        } else {
            $unreadBroadcast = "";
            $unreadPM = "";
        }
    } else {
        $unreadBroadcastChannels = $client->getUnreadBroadcastChannels();
        $unreadPMChannels = $client->getUnreadPMChannels();
        $unreadBroadcast = $unreadBroadcastChannels->count();
        $unreadPM = $unreadPMChannels->count();
    }

    return $app->render("account_user.twig", [
        "user"          => $user,
        "first_post"    => $firstPost,
        "last_post"     => $lastPost,
        "first_mention" => $firstMention,
        "last_mention"  => $lastMention,
        "nice_rank"     => $niceRank,
        "token"         => $token,
        "unreadBroadcast" => $unreadBroadcast,
        "unreadPM"      => $unreadPM
    ]);

})->bind("account_user")->value("username", "me");

$app->get("/authorised_users", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    $client = $app["adn.client"];

    $authorizedUserIDs = $client->getAuthorizedUserIDs();

    return $app->render("user_ids.twig", [
        "authorizedUserIDs" => $authorizedUserIDs
    ]);

})->bind("authorised_users")->value("username", "me");

$app->get("/account/follow_comparison.php", $redirector("account_follow_comparison"));
$app->get("/account/follow_comparison", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    if (!$otherUsername = trim($req->get("id"), "@ ")) {
        return $app->render("user_comparison_form.twig");
    }

    $client = $app["adn.client"];
    $currentUser = $client->getAuthorizedUser();

    if ($otherUsername === $currentUser->username) {
        return $app->render(
            "user_comparison_error.twig",
            ["message" => "You can't do it with your own username! <strong>Enter
            another user above.</strong>"]
        );
    }

    $otherUser = $client->getUser($otherUsername);
    $otherUserFollowing   = $client->getUserFollowingIds($otherUsername);
    if (count($otherUserFollowing) === 0) {
        return $app->render(
            "user_comparison_error.twig",
            ["message" => "The user you have selected doesn't follow anyone.
                          <strong>Enter another user above.</strong>"]
        );
    }

    $currentUserFollowing = $client->getAuthorizedUserFollowingIds();

    $vdiff = function (NumberCollection $left, NumberCollection $right) {
        return array_values(array_diff($left->toArray(), $right->toArray()));
    };

    $otherUserFollowing->sort();
    $currentUserFollowing->sort();

    $otherUserFollowsExclusively   = $vdiff($otherUserFollowing, $currentUserFollowing);
    $currentUserFollowsExclusively = $vdiff($currentUserFollowing, $otherUserFollowing);

    $usersToFollow = [];

    $goal = 20;
    while (true) {
        // if we've hit our goal
        if (count($usersToFollow) >= $goal) {
            break;
        }

        // if we've got no more possiblities
        if (!$otherUserFollowsExclusively) {
            break;
        }

        $guess = mt_rand(0, count($otherUserFollowsExclusively) - 1);
        if (!isset($otherUserFollowsExclusively[$guess])) {
            die(var_dump($guess, $otherUserFollowsExclusively));
        }
        $nextUser = $otherUserFollowsExclusively[$guess];
        unset($otherUserFollowsExclusively[$guess]);
        $otherUserFollowsExclusively = array_values($otherUserFollowsExclusively);

        // if the guess is us, remove and skip it
        if ($nextUser === $currentUser->id) {
            continue;
        }

        $usersToFollow[] = $nextUser;
    }

    $retrievedUsers = $client->getUsers($usersToFollow);

    return $app->render(
        "user_comparison.twig",
        [
            "currentUser"                   => $currentUser,
            "otherUser"                     => $otherUser,
            "retrievedUsers"                => $retrievedUsers,
            "otherUserFollowsExclusively"   => $otherUserFollowsExclusively,
            "currentUserFollowsExclusively" => $currentUserFollowsExclusively,
        ]
    );

})->bind("account_follow_comparison");

$app->get("/broadcast/lookup.php", $redirector("broadcast_lookup"));
$app->get("/broadcast/lookup", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    $identifier = $req->get("id", 34622);
    $channel    = $app["adn.client"]->getChannel($identifier);
    $messages   = $app["adn.client"]->getChannelMessages($identifier);

    return $app->render("broadcast_lookup.twig", compact("channel", "messages"));
})->bind("broadcast_lookup");

//TODO: change this to POST / DELETE, not GET
$app->get("/user/unfollow", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    return $app->json($app["adn.client"]->unfollowUser($req->get("id"))->json());
})->bind("unfollow");

$app->get("/user/follow", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    return $app->json($app["adn.client"]->followUser($req->get("id"))->json());
})->bind("follow");

$app->get("/user/patch_annotations", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    return $app->json($app["adn.client"]->patchAnnotations($req->get("type"), $req->get("content_type"), $req->get("content"), $req->get("process"))->json());

    // return $app->json($app["adn.client"]->patchAnnotations($req->get("type"), $req->get("content_type"), $req->get("content")));
})->bind("annotations");

$app->get("/account/annotations", function (Request $req) use ($app) {
    if (!$app["adn.user"]) {
        return $app->render("unauth_message.twig");
    }

    $client = $app["adn.client"];

    $user = $client->getAuthorizedUser(["include_user_annotations" => true]);

    return $app->render("account_annotations.twig", [
        "user"          => $user
    ]);

})->bind("account_annotations")->value("username", "me");

$app->get("/oss", $redirector("opensource"));
$app->get("/oss.php", $redirector("opensource"));
$app->get("/opensource.php", $redirector("opensource"));
$app->get("/opensource", function (Request $req) use ($app) {
    $settings = $app["adn.settings"];

    $client = new \Github\Client();
    $paginator  = new Github\ResultPager($client);

    $client->authenticate($settings["GITHUB_TOKEN"], Github\Client::AUTH_HTTP_TOKEN);

    $github_user = $client->api('organization')->show('purplapp');
    $github_repositories = $client->api('repo')->show('purplapp', 'purplapp');
    $github_repo_contributors = $client->api('repo')->contributors('purplapp', 'purplapp', false);
    $github_repo_language = $client->api('repo')->languages('purplapp', 'purplapp');

    // get the pull requests for the repository
    $github_repo_pull = $client->api('pull_request')->all('purplapp', 'purplapp', array('state' => 'all'));
    $github_repo_pull_comments_response = $client->getHttpClient()->get('/repos/purplapp/purplapp/comments');
    $github_repo_pull_comments = Github\HttpClient\Message\ResponseMediator::getContent($github_repo_pull_comments_response);

    // get the releases from the repository
    $github_repo_releases = $client->api('repo')->releases()->all('purplapp', 'purplapp');

    // get the statistics from the repository
    $github_repo_statistics = $client->api('repo')->statistics('purplapp', 'purplapp');

    // get total number of commits
    $github_commitsApi = $client->repo()->commits();
    $github_parameters = array('purplapp', 'purplapp', array('sha' => 'master'));
    $github_repo_commits = $paginator->fetchAll($github_commitsApi, 'all', $github_parameters);

    // get total number of issues
    $github_issuesApi = $client->issues();
    $github_parameters = array('purplapp', 'purplapp', array('state' => 'all'));
    $github_repo_issues = $paginator->fetchAll($github_issuesApi, 'all', $github_parameters);

    // get total number of comments on issues
    $github_issuesCommentsApi = $client->issues()->comments();
    $github_parameters = array('purplapp', 'purplapp', '');
    $github_repo_issues_comments = $paginator->fetchAll($github_issuesCommentsApi, 'all', $github_parameters);

    $github_code_frequency_response = $client->getHttpClient()->get('/repos/purplapp/purplapp/stats/code_frequency');
    $github_code_frequency = Github\HttpClient\Message\ResponseMediator::getContent($github_code_frequency_response);

    $github_participation_response = $client->getHttpClient()->get('/repos/purplapp/purplapp/stats/participation');
    $github_participation = Github\HttpClient\Message\ResponseMediator::getContent($github_participation_response);

    return $app->render("opensource.twig", [
        "github_user"   => $github_user,
        "github_repositories"    => $github_repositories,
        "github_repo_contributors"     => $github_repo_contributors,
        "github_repo_language" => $github_repo_language,
        "github_repo_pull" => $github_repo_pull,
        "github_repo_pull_comments"  => $github_repo_pull_comments,
        "github_repo_releases" => $github_repo_releases,
        "github_repo_statistics" => $github_repo_statistics,
        "github_repo_commits" => $github_repo_commits,
        "github_repo_issues" => $github_repo_issues,
        "github_repo_issues_comments" => $github_repo_issues_comments,
        "github_code_frequency" => $github_code_frequency,
        "github_participation" => $github_participation,
    ]);
})->bind("opensource");
