<?php
	#$res="";
	$test=$_SERVER['REMOTE_ADDR'];
	$server= $_SERVER['SERVER_NAME'];
	$server=str_replace("www.","",$server);

	switch ($server) {
	case "bstrap.purplapp.eu":
	#Header("Location: ./bstrap/");
	include("./bstrap.purplapp/index.php");
	#$_path="./bstrap.purplapp/";
	break;
	default:
	include("./index.php");
}
?>
