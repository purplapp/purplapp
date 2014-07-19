<?php
  	$title = "Sign in to Purplapp using App.net"; 
	
	require_once 'ControlAppDotNet.php';

	$app = new EZAppDotNet();

    include('../static/headers/header_unauth.php');

	if ($app->getSession()) {
	    header('Location: ./index.php');
	} else {
	    $url = $app->getAuthUrl();
	    echo "<div class='container'>";
	    echo '<br><a class="btn btn-social btn-adn" href="'.$url.'">
			    <i class="fa fa-adn"></i> Sign in with App.net
			  </a>';
		echo "<br><br><i><p>We ask to see basic information about you, and to allow us to send and receive the following types of messages: <strong>Broadcast Messages</strong>.<br>However, we do not send Broadcast messages for you. That would be against our moral values.</i></p>";
		echo "</div>";
	}
	
    include('../static/footers/footer.php');
?>	    
