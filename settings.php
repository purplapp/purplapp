<?php

Container::storeEnvParam("CLIENT_ID");
Container::storeEnvParam("CLIENT_ID");
Container::storeEnvParam("CLIENT_SECRET");
Container::storeEnvParam("ALPHA_DOMAIN");
Container::storeEnvParam("SUPPORT_EMAIL");
Container::storeEnvParam("GITHUB_URL");
Container::storeParam("REDIRECT_URL", "http://{$_SERVER["HTTP_HOST"]}/adn/callback.php");
Container::storeParam("API_SCOPE", array(
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
));
