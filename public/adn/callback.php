<?php require __DIR__ . "/../../bootstrap.php";

sess()->setSession((int) isset($_SESSION["rem"]));

header("Location: /index.php");
