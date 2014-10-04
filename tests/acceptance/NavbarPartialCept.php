<?php

$pages = array(
    "/",
    "/account",
    "/broadcast",
    "/donate",
    "/about",
    "/signin",
    "/legal/privacy",
    "/legal/terms",
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
$verifyLinksAvailable("Account Tools", "/account");
$verifyLinksAvailable("Broadcast Tools", "/broadcast");
$verifyLinksAvailable("Donate", "/donate");
$verifyLinksAvailable("About", "/about");
