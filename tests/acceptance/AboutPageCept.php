<?php

$I = new AcceptanceTester($scenario);

// fix chaining w/ &&
$see = function (array $perms) use ($I) {
    foreach ($perms as $thing) {
        $I->see($thing);
    }
};

$I->wantTo("make sure the page describes the site");
$I->amOnPage("/about.php");
$I->see("About Purplapp", "h1");
$see(["Dribbble", "iOS", "concept"]);

$I->wantTo("see the awesome team members");
$I->see("Team", "h2");
$see(["Charlotte", "Johannes", "Hugo", "Brandon", "Jessica Dennis"]);

$I->wantTo("give credit to the awesome OSS libs we're using");
$see([
    "Font Awesome", "Dave Gandy", "fontawesome.io",
    "PCA Icons", "Yusuke Kamiyamane", "p.yusukekamiyamane.com",
    "Glyphicon Halflings", "glyphicons.com"
]);

foreach (array("purplapp", "charl", "jvimedia", "hu", "remus", "jessicadennis") as $handle) {
    $I->seeLink("@{$handle}", "https://alpha.app.net/{$handle}");
}

$I->seeLink("Email");
$I->seeLink("GitHub");
