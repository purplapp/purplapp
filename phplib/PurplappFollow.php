<?php
  require_once './ControlAppDotNet.php';
  
  $app = new EZAppDotNet();

  // check that the user is signed in
  if ($app->getSession()) {
    // get the post_id
    $user_id=$_GET["id"];
       
    // get if repost or delte repost
    $operation=$_GET["op"];

    if (!$operation){
      $operation="f";
    }

    // debug:
    // echo $post_id;
    
    // optimize with switch case maybe. 
    if ($operation == "uf"){
      $response = $app->unfollowUser("$user_id");
    } elseif($operation == "f") {
      $response = $app->followUser("$user_id");
    }
  } else {
    $url = $app->getAuthUrl();
    
    $response = "Authentication Error";
    echo '<a href="'.$url.'"><h2>Sign in using App.net</h2></a>';
  }
?>