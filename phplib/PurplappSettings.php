<?php
	$app_clientId     = 'eQLzaREHPBZ54EFUna68MAN9AnyrLubP'; 	// declare the client ID
	$app_clientSecret = 'q279wdrVZmHfNr9uzzzY5Kq4FYXebRSC';		// declare the client secret
	
	$server = $_SERVER['HTTP_HOST']; // get the local server the purplapp install is running on
	$app_redirectUri  = "http://".$server."/phplib/PurplappCallback.php"; // declare the redirect uri for the App.net oauth
	
	$alpha = 'https://alpha.app.net/'; 		// declare the alpha domain to use
	
	$support = 'support@jvimedia.org';		// declare the support email to be used
	
	$github = 'http://github.com/purplapp';		// declare the github URL
	
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
?>