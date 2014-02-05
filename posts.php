<!DOCTYPE html>
<html>
<head>
  <meta name="description" content="Purplapp is an app.net app for stats. Here is the page for user information stats.">
  <meta name="keywords" content="ADN,appdotnet,app.net,posts,pca,purplapp">
  <meta name="author" content="Purplapp">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="utf-8">

  <!--Grab Stylesheets-->
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="http://bootstrap-fugue.azurewebsites.net/css/bootstrap-fugue-min.css"/>

  <?php
    //Required files
    require('config.php');
    require('posts.class.php');

    if(!empty($_GET['u'])) {
      $userID = $_GET['u'];
    } else {
      $userID = "@charl";
    }

    //Set Default Timezone
    date_default_timezone_set('utc');

    //Pulling From posts.class.php and Interpreting
    $posts = new Posts;

    $posts->setUserID($userID);
    $posts->getPosts();
    $posts->getClubs();
    $posts->getData();

    $data = $posts->user_data;
    $anno = $data->annotations;

    //Declaring UserType
    $usertype = ucfirst($data->type);

    //calculating date created
    $date = new DateTime($data->created_at);
    $dateresult = $date->format('Y-m-d H:i:s');

    //calculate current date and date created (again)
    $today = date('Y-m-d');
    $createdat= $data->created_at;

    //calculate number of days on ADN
    $date1 = new DateTime($createdat);
    $date2 = new DateTime($today);
    $interval = $date1->diff($date2);

    //calculate posts per day
    $ppd = $data->counts->posts / $interval->days
  ?>

  <title>User Information for @<? echo $data->username; ?></title>

  <!-- header.php -->
  <?php include "include/header.php"; ?>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/navbar-static-top.css" rel="stylesheet">

  <!-- Modifications -->
  <link href="css/mod.css" rel="stylesheet">
</head>

<body>
<div class="container">
  <?php if($posts->getData() !== false) { ?>
  <?php if($data->counts->posts !== 0) { ?>
    <div class="col-md-12">
      <h1><?php echo $data->name ?></h1>
      <h3><?php echo "<a class='url' href=".$data->canonical_url.">@".$data->username."</a>" ?></h3>

      <!--Avatar Image-->
      <img class="avatar" src="<?php echo $data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

      <!--Cover Image-->
      <img class="cover" src="<?php echo $data->cover_image->url; ?>" alt="cover" height="180" /> 

      <br><br>

      <!--Username Search Box-->
      <form method='GET' action=''>
        <input type='text' name='u' value="<?php echo $data->username; ?>"/>
        <input type='submit' />
      </form>
      
      <br>
      
      <!--User Bio-->
      <p class="bio">
        <?php echo $data->description->html; ?>
      </p>
    </div>

    <div class="col-md-6">
      <!--Info-->
      <table class="table">
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
          <td>ADN Age:</td>
          <td><?php echo $interval->days; ?></td>
        <tr>
          <td>Locale:</td>
          <td><?php echo $data->locale; ?></td>
        </tr>
        <tr>
          <td>Posts Per Day:
          <td><?php echo round($ppd, 2); ?></td>    
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"core.directory.blog") != false){
              	$blogurl=$annoC->value->url;
                echo "<td>Blog:</td>";
                echo "<td>";
                echo "<a href=\"$blogurl\">$blogurl</a>";
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"core.directory.facebook") != false){
              	$faceurl=$annoC->value->id;
                echo "<td>Facebook ID:</td>";
                echo "<td>";
                echo "<a href=\"http://facebook.com/$faceurl\">$faceurl</a>";
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"core.directory.twitter") != false){
              	$twiturl=$annoC->value->username;
                echo "<td>Twitter Handle:</td>";
                echo "<td>";
                echo "<a href=\"http://twitter.com/$twiturl\">@$twiturl</a>";
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
            if($data->verified_domain) {
              echo "<td>Verified Domain:</td>";
              echo "<td>";
              echo "<a class='url' href='http://".$data->verified_domain."'>http://".$data->verified_domain."</a>";
              echo "</td>";
            }
          ?>
        </tr>
      </table>
    </div>

    <div class="col-md-6">
      <h3 style="margin-top: -3px;"><a href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements">Post Count Achievements</a></h3>
      <div class="pca">
        <ul class="list-unstyled">
          <?php 
          foreach($posts->memberclubs as $club){
            echo "<li>".$club."</li>";
            }
          ?>
        </ul>
      </div>
    </div>
    
  <?php } else { echo "This user doesn't have any posts!"; } ?>
  <?php } else { echo "Data not loaded: this account doesn't exist or isn't marked as a human."; } ?>

  <!-- footer.php -->
  <?php include "include/posts_footer.php"; ?>
  
</div> 
</body>
</html>