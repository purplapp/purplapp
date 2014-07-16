<?php 
  require_once '../../ADN_php/EZAppDotNet.php'; // get the EZAppDotNet.php library 
  require('../../ADN_php/ErrorHandler.php'); // get the error handling functions

  // error reporting 
  error_reporting(E_ALL);
   ini_set("display_errors", 1); // this should be disabled in production  
//  ini_set('display_errors', 0); // this should be enabled in production

  $title = "Purplapp"; 

  $app = new EZAppDotNet();

  if ($app->getSession()) {
    // get the authorised user's data
    $auth_user_data = $app->getUser();
    $auth_username = $auth_user_data['username'];

    // get headers
    include('../headers/header_auth.php'); 
?>

<!-- Left Column -->
<div class="jumbotron">
  <h1>Error 404 - Not Found</h1>
  <p>Purplapp is an app for App.net statistics, and you just found a flaw in it. Nice one!</p>
</div>

<?php 
  } else {
    include('../headers/header_unauth.php'); 
    $url = $app->getAuthUrl();
?>

<!-- Left Column -->
<div class="jumbotron">
  <h1>Welcome!</h1>
  <p>Purplapp is an app for App.net statistics.</p>
  <p>
    <a href="<?php echo $url; ?>" class="btn btn-lg btn-social btn-adn">
      <i class="fa fa-adn"></i> Sign in with App.net
    </a>
  </p>
</div>

<?php
  }
  include('../footers/footer.php');
?>