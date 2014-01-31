<?php
//Required files
require('config.php');
require('posts.class.php');

if(!empty($_GET['u'])) {
  $userID = $_GET['u'];
} else {
  $userID = "@charl";
}

$posts = new Posts;

$posts->setUserID($userID);
$posts->getPosts();
$posts->getClubs();
$posts->getData();

$data = $posts->user_data;
$usertype = ucfirst($data->type);

$date = new DateTime($data->created_at);
$dateresult = $date->format('Y-m-d H:i:s');

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Information for @<? echo $data->username; ?></title>
  <meta name="description" content="Purplapp is an app.net app for stats. Here is the page for user information stats.">
  <meta name="keywords" content="appdotnet,ADN,app.net,app,pca,clubs">
  <meta name="author" content="Charl Dunois">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="http://bootstrap-fugue.azurewebsites.net/css/bootstrap-fugue-min.css"/>

  <link rel="stylesheet" type="text/css" href="css/posts.css" />

  <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//d2zh9g63fcvyrq.cloudfront.net/adn.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'adn-button-js'));</script>
  <script type="text/javascript" src="midway.min.js"></script>
</head>

<body>
<div id="divMain">
<?php if($posts->getData() !== false) { ?>
<?php if($data->counts->posts !== 0) { ?>
  <?php //var_dump($data); ?>
  <h1><?php echo $data->name ?></h1>
  <h3><?php echo "<a class='url' href=".$data->canonical_url.">@".$data->username."</a>" ?></h3>

  <!--Avatar Image-->
  <img class="avatar" src="<?php echo $data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

  <!--Cover Image-->
  <img class="cover" src="<?php echo $data->cover_image->url; ?>" alt="cover" height="180" /> 

  <!--Follow Icon-->
  <br>

  <!--Username Search Box-->
  <form method='GET' action=''>
    <input type='text' name='u' value="<?php echo $data->username; ?>"/>
    <input type='submit' />
  </form>
  
  <br>
  
  <!--Profile URL-->
  
  <!--Authorised URL-->  
  <?php

  if($data->verified_domain) {
    echo "<a class='url' href='http://".$data->verified_domain."'>Verified Domain:  \"".$data->verified_domain."\"</a>";
  }

  ?>

  <!--User Bio-->
  <p class="bio">
    <?php echo $data->description->html; ?>
  </p>

  <hr>

  <!--Info-->
  <table class="table">
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Posts:</td>
        <td><?php echo $data->counts->posts; ?></td>
    </tr>
    <tr>
        <td>Starred:</td>
        <td><?php echo $data->counts->stars; ?></td>
    </tr>
    <tr>
        <td>Following:</td>
        <td><?php echo $data->counts->following; ?></td>
    </tr>
    <tr>
        <td>Followers:</td>
        <td><?php echo $data->counts->followers; ?></td>
    </tr>
    <tr>
        <td>Account Type:</td>
        <td><?php echo $usertype; ?></td>
    </tr>
    <tr>
        <td>Location:</td>
        <td><?php echo $data->timezone; ?></td>
    </tr>
    <tr>
        <td>User Number:</td>
        <td><?php echo $data->id; ?></td>
    </tr>
    <tr>
      <td>Joined:</td>
      <td><?php echo $dateresult; ?></td>
    </tr> 
    <tr>
      <td>Locale:</td>
      <td><?php echo $data->locale; ?></td>
    </tr>
  </table>

  <hr>

  <?php //echo $data->['annotations']['com.appnetizens.userinput.birthday']['value']['birthday']); ?>

  <h3><a href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements"> Post Count Achievements</a></h3>
  <div class="pca">
    <ul class="pcatable">
      <?php 
      foreach($posts->memberclubs as $club){
        echo "<li>".$club."</li>";
        }
      ?>
    </ul>
  </div>
  
  <?php } else { echo "This user doesn't have any posts!"; } ?>
  <?php } else { echo "Data not loaded: this account isn't marked as a human."; } ?>

  <hr>

  <p class="credits">
  Built by <a href="https://app.net/charl">@charl<a/> with assistance from <a href="https://app.net/jvimedia">@jvimedia</a> and <a href="https://app.net/hu">@hu</a>.<br><a href='http://p.yusukekamiyamane.com/' target='_blank'>PCA Icons</a>
  <br>
  Hosted by <a href="http://jvimedia.org">jvimedia.org</a>.
  <br>
  <br>
  If you want to see your PCA clubs simply, check out <a href="/pca.php?id=<?php echo $userID?>">pca.php</a> instead.
  </p>
  <a href='https://app.net/c/2zdw' class='adn-button' target='_blank' data-type='subscribe' data-width='139' data-height='21' data-size='11' data-channel-id='34622' >Subscribe on App.net</a>
  <br>
  <a href='https://alpha.app.net/purplapp' class='adn-button' target='_blank' data-type='follow' data-width='176' data-height='27' data-user-id='@purplapp' data-show-username='1' frameborder="0"; style="width: 280px;" rel='me'>Follow @purplapp on App.net</a>
</div> 
</body>
</html>