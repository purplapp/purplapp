<?php require __DIR__ . "/../bootstrap.php";

$app = sess();

if ($app->getSession()) {
    header("Location: /index.php");
    return;
}

echo render("signin.twig", array("auth_url" => $app->getAuthUrl()));
