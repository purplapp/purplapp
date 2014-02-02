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

<!DOCTYPE html>
<html>
<head>
  <title>User Information for @<? echo $data->username; ?></title>
  <meta name="description" content="Purplapp is an app.net app for stats. Here is the page for user information stats.">
  <meta name="keywords" content="ADN,appdotnet,app.net,posts,pca,purplapp">
  <meta name="author" content="Purplapp">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="utf-8">

  <!--Grab Stylesheets-->
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <link rel="stylesheet" href="http://bootstrap-fugue.azurewebsites.net/css/bootstrap-fugue-min.css"/>
  <link rel="stylesheet" type="text/css" href="css/posts.css" />

  <!--ADN Buttons-->
  <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//d2zh9g63fcvyrq.cloudfront.net/adn.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'adn-button-js'));</script>
</head>

<body>
<div id="divMain">
  <?php if($posts->getData() !== false) { ?>
  <?php if($data->counts->posts !== 0) { ?>
    <a href="/index.html">Go Home</a>
    <h1><?php echo $data->name ?></h1>
    <h3><?php echo "<a class='url' href=".$data->canonical_url.">@".$data->username."</a>" ?></h3>

    <!--Avatar Image-->
    <img class="avatar" src="<?php echo $data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

    <!--Cover Image-->
    <img class="cover" src="<?php echo $data->cover_image->url; ?>" alt="cover" height="180" /> 

    <!--Username Search Box-->
    <form method='GET' action=''>
      <input type='text' name='u' value="<?php echo $data->username; ?>"/>
      <input type='submit' />
    </form>
    
    <br>
    
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
              echo "<a href=\"http://twitter.com/$twiturl\">$twiturl</a>";
              echo "</td>"; }}
        ?>
      </tr>
    </table>
    
    <hr>

    <h3><a href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements">Post Count Achievements</a></h3>
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
  <?php } else { echo "Data not loaded: this account doesn't exist or isn't marked as a human."; } ?>

  <hr>

  <p class="credits">
    Built by <a href="https://app.net/charl">@charl<a/> with assistance from <a href="https://app.net/jvimedia">@jvimedia</a> and <a href="https://app.net/hu">@hu</a>.
    <br>
    <a href='http://p.yusukekamiyamane.com/' target='_blank'>PCA Icons</a>
    <br>
    Hosted by <a href="http://jvimedia.org">jvimedia.org</a>.
    <br><br>
    It costs money to keep Purplapp going, and we want to continue bringing you new features we cannot currently.<br>Help us improve ADN by donating! :)
    <br><br>
    <?php 
      include("./other_plugins/Donatdex.html"); 
    ?>
    <br><br>
    <a href='https://app.net/c/2zdw' class='adn-button' target='_blank' data-type='subscribe' data-width='139' data-height='21' data-size='11' data-channel-id='34622' >Subscribe on App.net</a>
    <br>
    <a href='https://alpha.app.net/purplapp' class='adn-button' target='_blank' data-type='follow' data-width='176' data-height='27' data-user-id='@purplapp' data-show-username='1' frameborder="0"; style="width: 280px;" rel='me'>Follow @purplapp on App.net</a>
  </p>
</div> 
</body>
</html>