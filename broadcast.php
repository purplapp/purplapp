<?php 
    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);   

	$title = "Broadcast Tools - Purplapp"; 

	require_once './ADN_php/EZAppDotNet.php';
	$app = new EZAppDotNet();

	if ($app->getSession()) {
		include('include/header_auth.php');
?>

<div class="col-md-12">
	<div class="page-header">
		<h1>Tools for Broadcast Channels</h1>
	</div>
</div>

<div class="col-md-6">
	<div class="jumbotron">
	  <h1>Broadcast Channel Lookup Tool</h1>
	  <p>We made a neat little tool for looking up information on Broadcast channels. Enter in the channel ID and hit enter, and we'll give you some info on the latest posts from the channel.</p>
	  <p><a href="/broadcast/lookup.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<?php 
  } else {
    include('./include/header_unauth.php'); 
?>

<div class="col-md-12">
	<div class="page-header">
		<h1>Tools for Broadcast Channels</h1>
	</div>
</div>

<div class="col-md-6">
	<div class="jumbotron">
	  <h1>Broadcast Channel Lookup Tool</h1>
	  <p>We made a neat little tool for looking up information on Broadcast channels. Enter in the channel ID and hit enter, and we'll give you some info on the latest posts from the channel.</p>
	  <p><a href="/broadcast/lookup.php" class="btn btn-primary btn-lg" role="button">Learn more</a></p>
	</div>
</div>

<?php
  }
  include('include/footer.php');
?>