<?php require __DIR__ . "/../../bootstrap.php";

$app = sess();

// set the user params to receive
$user_params = array(
    'include_user_annotations' => true,
);

// check that the user is signed in
if (!$app->getSession()) {
    echo render("unauth_message.twig", array("auth_url" => $app->getAuthUrl()));
    return;
}

$username = empty($_GET["id"]) ? "me" : $_GET["id"];

// get the data for the authorised user
$auth_user_data = $app->getUser();
$auth_username = $auth_user_data['username'];

if ($username == 'me') {
    // if username is the authorised user
    try {
        $data = $app->getUser('me', $user_params);
    } catch(AppDotNetException $x) {
        echo 'Caught exception: ', $x->getMessage(), "\n";
    }
    $user_number = $data['id'];
    $username = $data['username'];
} else {
    // if username is not the authorised user
    $username = ltrim($username, '@');
    $user_number = $app->getIdByUsername($username);
    $data = $app->getUser($user_number, $user_params);
}

//calculate date created for day calc
$createdat= new DateTime($data['created_at']);
$adnjoin = $createdat->format('Y-m-d H:i:s');

//calculate number of days on ADN
$date1 = new DateTime($adnjoin);
$date2 = new DateTime($today);
$interval = $date1->diff($date2);

// pca club functions
$clubs = new PostClubs;
$clubs->setAlpha(getenv("ALPHA_DOMAIN"));
$clubs->setUserPost($data['counts']['posts']);
$clubs->setUserID($data['id']);
$clubs->getClubs();
$clubs->nextClubs();
$next_clubs = $clubs->nextclubs;
$club_count = $clubs->club_count;
$user_clubs = $clubs->memberclubs;
$next_clubs = $clubs->nextclubs;

// post-date functions
$posts = new PostData;

// birthday
$birthdate = new BirthdayData;

// nicerank
$nicerank = new NiceRank;
$nicerank->setUserID($user_number);
$nicerank->getNiceRank();
$nice_rank_data = $nicerank->nicerank;

$EntityProcessor = new EntityProcessor;
if (isset($data['description']['html'])) {
    $processed_bio = $EntityProcessor->BioProcessor($data);
}

echo render(
    "account_user.twig",
    array(
        "posts"           => $posts,
        "app"             => $app,
        "data"            => $data,
        "username"        => $username,
        "processed_bio"   => $processed_bio,
        "auth_username"   => $auth_username,
        "user_number"     => $user_number,
        "nice_rank_data"  => $nice_rank_data,
        "next_clubs"      => $next_clubs,
        "user_clubs"      => $user_clubs,
        "clubs"           => $clubs,
        "interval"        => $interval,
        "EntityProcessor" => $EntityProcessor,
    )
);
