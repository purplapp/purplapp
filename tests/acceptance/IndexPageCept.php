<?php

$I = new AcceptanceTester($scenario);

$I->wantTo("check that our front page is welcoming");
$I->amOnPage('/');
$I->see("Welcome!", "h1");

$I->wantTo("make sure we've got a link to our github repo");
$I->seeLink("GitHub", "https://github.com/purplapp");
