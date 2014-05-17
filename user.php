<?php
    $id = $_GET["id"];
    header("refresh: 5; ./account/user.php?id=".$id."");

    include('include/header_unauth.php');
    echo "<h1>This link is deprecated. Please change your link. <small>Redirecting now...</small></h1>";
    include('include/footer.php');
?>