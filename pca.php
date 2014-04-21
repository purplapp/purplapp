<?php
$id = $_GET["id"];
header("refresh: 5; ./account/pca.php?id=".$id."");

include('include/header.php');
echo "<h1>This link is deprecated. Please change your link. <small>Redirecting now...<small></h1>";
?>