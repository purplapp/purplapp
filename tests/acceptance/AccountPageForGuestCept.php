<?php
$I = new AcceptanceTester($scenario);
// $I->amAGuest();

$I->wantTo("see an invitation to sign in when I'm a guest");
$I->amOnPage("/account.php");
$I->see('Want to use any of these? Hit "Sign in" above and get started');
$I->seeLink("Sign in");

$I->wantTo("check there are no links to tools when I'm a guest");
$I->dontSeeLink("User Lookup Tool");
$I->dontSeeLink("First Mention Tool");
$I->dontSeeLink("Following Comparison Tool");
