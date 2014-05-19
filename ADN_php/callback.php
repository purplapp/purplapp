<?php
	require_once 'EZAppDotNet.php';

	$app = new EZAppDotNet();

	// if 'Remember me' was checked...
	if (isset($_SESSION['rem'])) {
		$token = $app->setSession(1);
	} else {
		$token = $app->setSession();
	}

	// redirect user after logging in
	header('Location: /index.php');
?>
