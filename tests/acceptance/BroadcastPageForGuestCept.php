<?php
$I = new AcceptanceTester($scenario);
// $I->amAGuest();

$I->wantTo('see "Tools for Broadcast Channels" in the title');
$I->amOnPage("/broadcast.php");
$I->see("Tools for Broadcast Channels", "h1");
$I->seeInTitle("Broadcast Tools");

$I->wantTo('see a link to "Learn more" about the BC lookup tool');
$I->seeLink("Learn more");
