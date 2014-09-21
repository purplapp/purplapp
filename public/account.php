<?php 
	$title = "Account Tools - Purplapp"; 

    require_once './phplib/ControlAppDotNet.php'; // get the EZAppDotNet.php library

	$app = new EZAppDotNet();

	if ($app->getSession()) {
		// get the authorised user's data
		$auth_user_data = $app->getUser();
		$auth_username = $auth_user_data['username'];

		// get headers
		include('./static/headers/header_auth.php'); 
?>

<div class="col-md-12">
	<div class="page-header">
		<h1>Tools for Accounts</h1>
	</div>
</div>

<div class="col-md-12">
	<div class="jumbotron">
	  <h1>User Lookup Tool</h1>
	  <p>We made a tool for looking up information on users. Enter in the username and hit enter, and we'll give you some info on that user.</p>
	  <p><a href="/account/user.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<div class="col-md-12">
	<div class="jumbotron">
	  <h1>First Mention Tool</h1>
	  <p>Ever wanted to see what the first mentions between two users were? Well, we'll show you the first mentions of each user by the other.</p>
	  <p><a href="/account/mention.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<div class="col-md-12">
	<div class="jumbotron">
	  <h1>Following Comparison Tool</h1>
	  <p>Want to follow more people? Enter in a username, and it'll show you up to 20 randomly selected users which they follow, but you don't.</p>
	  <p><a href="/account/follow_comparison.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<?php 
  } else {
    include('./static/headers/header_unauth.php'); 
?>

<div class="page-header">
	<h1>Tools for Accounts</h1>
</div>

<p class="lead">
	Want to use any of these? Hit "Sign in" above and get started!
</p>

<div class="col-md-12">
	<div class="jumbotron">
	  <h1>User Lookup Tool</h1>
	  <p>We made a tool for looking up information on users. Enter in the username and hit enter, and we'll give you some info on that user.</p>
	</div>
</div>

<div class="col-md-12">
	<div class="jumbotron">
	  <h1>First Mention Tool</h1>
	  <p>Ever wanted to see what the first mentions between two users were? Well, we'll show you the first mentions of each user by the other.</p>
	</div>
</div>

<div class="col-md-12">
	<div class="jumbotron">
	  <h1>Following Comparison Tool</h1>
	  <p>Want to follow more people? Enter in a username, and it'll show you up to 20 randomly selected users which they follow, but you don't.</p>
	</div>
</div>

<?php
  }
  include('./static/footers/footer.php');
?>