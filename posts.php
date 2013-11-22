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

?>

<!DOCTYPE html>
<html>
<head>
  <title>User Information for <? echo $data->name; ?></title>
  <meta name="description" content="A test.">
  <meta name="keywords" content="Test,PHP">
  <meta name="author" content="Charl and Johannes">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" href="bootstrap.min.css"/>
  <link rel="stylesheet" href="http://bootstrap-fugue.azurewebsites.net/css/bootstrap-fugue-min.css"/>

  <style>
    body { font-family: Arial, sans-serif; }
    h1 { font-family: Arial, sans-serif;}
    p.url { font-family: Arial, sans-serif;}
    p.authurl { font-family: Arial, sans-serif;}
    p.charljvim { font-family: Arial, sans-serif;}
    p.bio { font-family: Arial; font-style: italic; sans-serif;}
    p.bioheader { font-family: Arial, sans-serif;}
    p.counts { font-family: Arial, sans-serif;}
    p.pca { font-family: Arial, sans-serif;}
    p.credits {font-family: Arial; font-style: italic; color:#808080; font-size:10px; sans-serif}

    a:link {text-decoration:none;}
    a:visited {text-decoration:none;}
    a:hover {text-decoration:none;}
    a:active {text-decoration:none;}

    div.sub, iframe {
        width: 280px;
        height: 30px;
        margin: 0 auto;
        background-color: #FFFFFF;
    }

    body {
      text-align: center; /* for ie6- */
    }

    div#container {
      text-align: left; /* fix alignment for ie */
      margin: 0 auto;
      width: 700px; /* if you want the width to be fixed, set to whatever you want */
    }
    
    table {
      margin: 0 auto;
    }

    ul {
      list-style-type: none;
    }

    div#midway-horizontal{ 
    text-align: center;
    }

  </style>
  <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//d2zh9g63fcvyrq.cloudfront.net/adn.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'adn-button-js'));</script>
  <script type="text/javascript" src="midway.min.js"></script>
</head>

<body>
<div id="divMain">
<?php if($posts->getData() !== false) { ?>
<?php if($data->counts->posts !== 0) { ?>
  <h1><?php echo $data->name ?></h1>

  <!--Avatar Image-->
  <img class="avatar" src="<?php echo $data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

  <!--Cover Image-->
  <img class="cover" src="<?php echo $data->cover_image->url; ?>" alt="cover" height="180" /> 

  <!--Follow Icon-->
  <div id="follow"> 
      <div class="sub"></div>
      <iframe src="http://adnbtns.com/adn-btn.html?user=<?php echo $data->username; ?>&size=large&align=center"  allowtransparency="true" frameborder="0" scrolling="0" width="280" height="30" ></iframe>
      <br>
  </div>

  <br>

  <!--Username Search Box-->
  <form method='GET' action=''>
    <input type='text' name='u' value="<?php echo $data->username; ?>"/>
    <input type='submit' />
  </form>

  <!--Profile URL-->
  <p class="url"><a class="url" href="<?php echo $data->canonical_url; ?>"><?php echo $data->name; ?>'s Profile URL</a>
    
  <!--Authorised URL-->  
  <?php

  if($data->verified_domain) {
    echo "- ";
    echo "<a class='url' href='http://".$data->verified_domain."'>Verified Domain:  \"".$data->verified_domain."\"</a>";
  }

  ?>

  <!--User Bio-->
  <p class="bio">
    <?php echo $data->description->html; ?>
  </p>

  <hr>

  <!--Info-->
  <table class="">
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
  </table>

  <hr>

  <h3><a href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements"> Post Count Achievements</a></h3>
  <ul>
    <?php 

    foreach($posts->memberclubs as $club) {
      echo "<li>".$club."</li>";
    }

    ?>
  </ul>
  <?php } else { echo "This user doesn't have any posts!"; } ?>
  <?php } else { echo "Data not loaded: this account isn't marked as a human."; } ?>

  <hr>

  <p class="credits">
  Built by <a href="https://app.net/charl">@charl<a/> with assistance from <a href="https://app.net/jvimedia">@jvimedia</a> and <a href="https://app.net/hu">@hu</a>.<br><a href='http://p.yusukekamiyamane.com/' target='_blank'>PCA Icons</a>
  <br>
  Hosted by <a href="http://jvimedia.org">jvimedia.org</a>.
  <br>
  November 2013
  </p>

  <a href='https://alpha.app.net/intent/subscribe/?channel_id=34622' class='adn-button' target='_blank' data-type='subscribe' data-width='141' data-height='21' data-size='11' data-channel-id='34622' >Subscribe for Purlapp news on App.net</a><br>
  <a href='https://alpha.app.net/purplapp' class='adn-button' target='_blank' data-type='follow' data-width='277' data-height='27' data-user-id='@purplapp' data-show-username='1' rel='me'>Follow @purplapp on App.net</a>
</div> 
</body>
</html>
