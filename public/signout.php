<?php require __DIR__ . "/../bootstrap.php";

sess()->deleteSession();

// redirect user after logging out
header('Location: /index.php');
