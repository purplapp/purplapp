<?php
$I = new AcceptanceTester($scenario);
// $I->amAGuest();

$reset = function () use ($I) {
    $I->amOnPage("/broadcast");
};

$reset();
$I->wantTo('see "Tools for Broadcast Channels" in the title');
$I->see("Tools for Broadcast Channels", "h1");
$I->seeInTitle("Broadcast Tools");

$I->wantTo("test that the link works correctly");
$I->click("Learn more");

$I->seeLink("Sign in with App.net", "https://account.app.net/oauth/authenticate");
$I->see("we do not send Broadcast messages for you");
