<?php
	require_once 'ControlAppDotNet.php';

	$app = new EZAppDotNet();

	// log out user
	$app->deleteSession();

	// redirect user after logging out
	header('Location: ../index.php');
?>
