<?php

$I = new AcceptanceTester($scenario);

$I->wantTo("check that our front page is welcoming");
$I->amOnPage('/');
$I->see("Welcome!", "h1");

$I->wantTo("make sure we've got a link to our github repo");
$I->seeLink("GitHub", "https://github.com/purplapp");

$I->wantTo("make sure we list our account features");
$I->see("Account Features", "h2");
$I->see("Find details on your account");
$I->see("Find the first mentions");
$I->see("Compare your followers with that");

$I->wantTo("make sure we list our account features");
$I->see("See the most recent 5 updates");
