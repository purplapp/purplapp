<?php 
	$title = "Purplapp - Error 404"; 
	
    require_once '../../phplib/ControlAppDotNet.php'; // get the EZAppDotNet.php library

    // get headers
    include('../headers/header_error.php'); 
?>

<!-- Left Column -->
<div class="jumbotron">
  <h1><i class="fa fa-warning"></i> Error 404 - Page Not Found</h1>
  <p>Oops. That's not supposed to happen...<br><br><strong>Please refresh the page and try again, or return to the previous page and follow the link again.</strong><br><br>If that doesn't help, please <a href="mailto:<?php echo $support; ?>" target="_top">drop us an email</a> (with the page you're on, and how you reached it) and we'll look into what is wrong. Thanks!</p>
</div>

<?php 
	include('../footers/footer.php');
?>
