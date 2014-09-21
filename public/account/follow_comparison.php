<?php require __DIR__ . "/../../bootstrap.php";

$app = sess();

if (!$app->getSession()) {
    echo render("unauth_message.twig", array("auth_url" => $app->getAuthUrl()));
    return;
}

$userParams = array(
    "include_user_annotations" => false,
);

if (empty($_GET["id"])) {
    echo render("user_comparison_form.twig");
    return;
}

$user = $app->getUser();
$otherUserId = trim($_GET["id"], "@ ");

if ($otherUserId === $user["username"]) {
    echo render(
        "user_comparison_error.twig",
        array(
            "message" => "You can't do it with your own username! <strong>Enter
                          another user above.</strong>",
        )
    );
    return;
}

$otherUser = $app->getUser($app->getIdByUsername($otherUserId), $userParams);

$userFollowing      = $app->getFollowingIDs($user["id"]);
$otherUserFollowing = $app->getFollowingIDs($otherUser["id"]);

if (count($otherUserFollowing) === 0) {
    echo render(
        "user_comparison_error.twig",
        array(
            "message" => "The user you have selected doesn't follow anyone.
                          <strong>Enter another user above.</strong>"
        )
    );
    return;
}

sort($userFollowing);
sort($otherUserFollowing);

$otherUserFollowsExclusively = array_values(array_diff($otherUserFollowing, $userFollowing));
$userFollowsExclusively      = array_values(array_diff($userFollowing, $otherUserFollowing));

$usersToFollow = array();

$goal = 20;
while (true) {
    // if we've hit our goal
    if (count($usersToFollow) >= $goal) {
        break;
    }

    // if we've got no more possiblities
    if (!count($otherUserFollowsExclusively)) {
        break;
    }

    $guess = mt_rand(0, count($otherUserFollowsExclusively) - 1);
    $nextUser = $otherUserFollowsExclusively[$guess];
    unset($otherUserFollowsExclusively[$guess]);

    // if the guess is us, remove and skip it
    if ($nextUser === $user["id"]) {
        continue;
    }

    $usersToFollow[] = $nextUser;
}

$retrievedUsers = $app->getUsers($usersToFollow);

echo render(
    "user_comparison.twig",
    compact(
        "user",
        "otherUser",
        "retrievedUsers",
        "otherUserFollowsExclusively",
        "userFollowsExclusively"
    )
);
