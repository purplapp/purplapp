<?php require __DIR__ . "/../../bootstrap.php";

$app = sess();

if (!$app->getSession()) {
    echo render("unauth_message.twig", array("auth_url" => $app->getAuthUrl()));
    return;
}

if (!isset($_GET["id1"]) && !isset($_GET["id2"])) {
    echo render("user_first_mention_form.twig");
    return;
}

$userParams = array(
    'include_user_annotations' => true,
);

$left  = isset($_GET["id1"]) ? $_GET["id1"] : "me";
$right = isset($_GET["id2"]) ? $_GET["id2"] : "me";

$left = ($left === "me") ? "me" : $app->getIdByUsername(ltrim($left, "@"));
$leftData = $app->getUser($left, $userParams);

$right = ($right === "me") ? "me" : $app->getIdByUsername(ltrim($right, "@"));
$rightData = $app->getUser($right, $userParams);

// get mentions of user 1 by user 2
$leftByRightParams = array(
    "mentions"                 => $leftData["username"],
    "creator_id"               => $right,
    "include_post_annotations" => true,
    "count"                    => "-1",
);

$rightByLeftParams = array(
    "mentions"                 => $rightData["username"],
    "creator_id"               => $left,
    "include_post_annotations" => true,
    "count"                    => "-1",
);

$rightByLeft = end($app->searchPosts($rightByLeftParams));
$leftByRight = end($app->searchPosts($leftByRightParams));

echo render(
    "user_first_mention.twig",
    compact("leftData", "rightData", "leftByRight", "rightByLeft")
);
