<?php

$app_clientId     = getenv("CLIENT_ID");
$app_clientSecret = getenv("CLIENT_SECRET");
$alpha            = getenv("ALPHA_DOMAIN");
$support          = getenv("SUPPORT_EMAIL");
$github           = getenv("GITHUB_URL");

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