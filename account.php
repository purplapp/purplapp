<?php 
    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);   

	$title = "Account Tools - Purplapp"; 

	require_once './ADN_php/EZAppDotNet.php';
	$app = new EZAppDotNet();

	if ($app->getSession()) {
		include('include/header_auth.php');
?>

<div class="col-md-12">
	<div class="page-header">
		<h1>Tools for Accounts</h1>
	</div>
</div>

<div class="col-md-6">
	<div class="jumbotron">
	  <h1>User Lookup Tool</h1>
	  <p>We made a tool for looking up information on users. Enter in the username and hit enter, and we'll give you some info on that user.</p>
	  <p><a href="/account/user.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<div class="col-md-6">
	<div class="jumbotron">
	  <h1>First Mention Tool</h1>
	  <p>Ever wanted to see what the first mentions between two users were? Well, we'll show you the first mentions of each user by the other.</p>
	  <p><a href="/account/mention.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<?php 
  } else {
    include('./include/header_unauth.php'); 
?>

<div class="col-md-12">
	<div class="page-header">
		<h1>Tools for Accounts</h1>
	</div>
</div>

<div class="col-md-6">
	<div class="jumbotron">
	  <h1>User Lookup Tool</h1>
	  <p>We made a tool for looking up information on users. Enter in the username and hit enter, and we'll give you some info on that user.</p>
	  <p><a href="/account/user.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<div class="col-md-6">
	<div class="jumbotron">
	  <h1>First Mention Tool</h1>
	  <p>Ever wanted to see what the first mentions between two users were? Well, we'll show you the first mentions of each user by the other.</p>
	  <p><a href="/account/mention.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<?php
  }
  include('include/footer.php');
?>