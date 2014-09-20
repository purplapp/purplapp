<?php

$pages = array(
    "/",
    "/account.php",
    "/broadcast.php",
    "/donate.php",
    "/about.php",
    "/phplib/PurplappLogin.php",
    "/legal/privacy.php",
    "/legal/terms.php",
);

$I = new AcceptanceTester($scenario);

$testAllPages = function ($closure) use ($pages, $I) {
    foreach ($pages as $page) {
        $I->amOnPage($page);
        $closure($I);
    };
};

$I->wantTo("test that the site title is a link to /");
$testAllPages(function ($I) {
    $I->seeLink("Purplapp", "/");
});

$verifyLinksAvailable = function ($text, $path) use ($testAllPages) {
    $testAllPages(function ($I) use ($text, $path) {
        $I->seeLink($text, $path);
    });
};

 $I->wantTo("test that navbar links are correct on all pages");
$verifyLinksAvailable("Account Tools", "/account.php");
$verifyLinksAvailable("Broadcast Tools", "/broadcast.php");
$verifyLinksAvailable("Donate", "/donate.php");
$verifyLinksAvailable("About", "/about.php");
