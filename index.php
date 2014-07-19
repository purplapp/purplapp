<?php 
  require_once './phplib/ControlAppDotNet.php'; // get the EZAppDotNet.php library

  $title = "Purplapp"; 

  $app = new EZAppDotNet();

  if ($app->getSession()) {
    // get the authorised user's data
    $auth_user_data = $app->getUser();
    $auth_username = $auth_user_data['username'];

    // get headers
    include('./static/headers/header_auth.php'); 
?>

<!-- Left Column -->
<div class="jumbotron">
  <h1>Welcome!</h1>
  <p>Purplapp is an app for App.net statistics.</p>
</div>

<div class="col-md-6">
  <h1>Features</h1>
  <h2>Account Features</h2>
  <p>
    <ul>
      <li><a href='./account/user.php'>Find details on your account and your PCA Clubs.</a></li>
      <li><a href='./account/mention.php'>Find the first mentions between two users.</a></li>
      <li><a href='./account/follow_comparison.php'>Compare your followers with that of another user.</a></li>
    </ul>
  </p>
  <h2>Broadcast Features</h2>
  <ul>
    <li><a href='./broadcast/lookup.php'>See the most recent 5 updates in any Broadcast channel.</a></li>
  </ul>
</div>

<!-- Right Column -->
<div class="col-md-6">
  <h1>Like what we've done?</h1>

  <p>
    Check us out on <a href='http://github.com/purplapp'>Github</a>!
    <br><br>
    It costs money to keep Purplapp going, and we want to continue bringing you new features we cannot currently. You can help us improve ADN by <a href='./donate.php'>donating!</a> :)
    <br><br>
    <script id='fbz61pq'>(function(i){var f,s=document.getElementById(i);f=document.createElement('iframe');f.src='http://api.flattr.com/button/view/?uid=jvimedia&button=compact&url=http%3A%2F%2Fpurplapp.eu';f.title='Flattr';f.height=20;f.width=110;f.style.borderWidth=0;s.parentNode.insertBefore(f,s);})('fbz61pq');</script>
    <br>
    <p><strong>We need £30 a month to keep the servers going. Here's the progress towards our goal!</strong></p>
    <div class="progress progress-striped">
      <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
        10%
      </div>
    </div>
  </p>
</div>

<?php 
  } else {
    include('./static/headers/header_unauth.php'); 
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

<div class="col-md-6">
  <h1>Features</h1>
  <h2>Account Features</h2>
  <p>
    <ul>
      <li>Find details on your account and your PCA Clubs.</li>
      <li>Find the first mentions between two users.</li>
      <li>Compare your followers with that of another user.</li>
    </ul>
  </p>
  <h2>Broadcast Features</h2>
  <ul>
    <li>See the most recent 5 updates in any Broadcast channel.</li>
  </ul>
</div>

<!-- Right Column -->
<div class="col-md-6">
  <h1>Like what we've done?</h1>

  <p>
    Check us out on <a href='http://github.com/purplapp'>Github</a>!
    <br><br>
    It costs money to keep Purplapp going, and we want to continue bringing you new features we cannot currently. You can help us improve ADN by <a href='./donate.php'>donating!</a> :)
    <br><br>
    <script id='fbz61pq'>(function(i){var f,s=document.getElementById(i);f=document.createElement('iframe');f.src='http://api.flattr.com/button/view/?uid=jvimedia&button=compact&url=http%3A%2F%2Fpurplapp.eu';f.title='Flattr';f.height=20;f.width=110;f.style.borderWidth=0;s.parentNode.insertBefore(f,s);})('fbz61pq');</script>
    <br>
    <p><strong>We need £30 a month to keep the servers going. Here's the progress towards our goal!</strong></p>
    <div class="progress progress-striped">
      <div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">
        10%
      </div>
    </div>
  </p>
</div>

<?php
  }
  include('./static/footers/footer.php');
?>