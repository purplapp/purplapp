<?php
  	$title = "Sign in to Purplapp using App.net"; 
	
	require_once 'EZAppDotNet.php';

	$app = new EZAppDotNet();

    include('../include/header_unauth.php');

	if ($app->getSession()) {
	    header('Location: ./index.php');
	} else {
	    $url = $app->getAuthUrl();
	    echo "<div class='container'>";
    	echo '<a href="'.$url.'"><h2>Sign in using App.net</h2></a>';
		if (isset($_SESSION['rem'])) {
			echo 'Remember me <input type="checkbox" id="rem" value="1" checked/>';
		} else {
			echo 'Remember me <input type="checkbox" id="rem" value="2" />';
		}
		echo "</div>";
	}
	
    include('../include/footer.php');
?>	    
