<?php

$rootDir = __DIR__ . "/..";

require "{$rootDir}/vendor/autoload.php";

Dotenv::load($rootDir);

Dotenv::required(array('CLIENT_ID', 'CLIENT_SECRET'));

// required
$app_clientId     = getenv("CLIENT_ID");
$app_clientSecret = getenv("CLIENT_SECRET");

// optional
$alpha   = getenv("ALPHA_DOMAIN")  ?: "https://alpha.app.net/";
$support = getenv("SUPPORT_EMAIL") ?: "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$github  = getenv("GITHUB_URL")    ?: "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";

$app_redirectUri  = "http://{$_SERVER["HTTP_HOST"]}/phplib/PurplappCallback.php";

$app_scope =  array(
    'basic', // See basic user info (default, required: may be given if not specified)
    // 'stream', // Read the user's personalized stream
    // 'email', // Access the user's email address
    // 'write_post', // Post on behalf of the user
    'follow', // Follow and unfollow other users
    'public_messages', // Send and receive public messages as this user
    'messages', // Send and receive public and private messages as this user
    // 'update_profile', // Update a user’s name, images, and other profile information
    // 'files', //  Manage a user’s files. This is not needed for uploading files.
    // 'export', // Export all user data (shows a warning)
);
