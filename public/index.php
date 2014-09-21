<?php require __DIR__ . "/../bootstrap.php";

echo render("index.twig", array("app" => sess()));
