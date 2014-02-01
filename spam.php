<!DOCTYPE html>
<html>

<head>
<?php
$c=$_GET[cd];
$c++;
$id=$_GET["id"];
if(!$id){ $id="@charl";}elseif($id==""){echo "";
$id="@charl";
 }

 if ($id[0]!="@"){ $id="@".$id;}

?>

<title>Is <? echo $id; ?> a spammer?</title>
<meta name="description" content="Purplapp is an app.net app for stats. Here is the page for post count stats.">
<meta name="keywords" content="appdotnet,ADN,app.net,app,pca,clubs">
<meta name="author" content="Charl Dunois">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php

//require config.php
require('config.php');
 
//Use the access token
$json = file_get_contents('https://alpha-api.app.net/stream/0/users/'.$id.'?access_token='.ACCESS_TOKEN.'&include_user_annotations=1?callback=awesome?jsonp=parseResponse');
$obj = json_decode($json); 
$posts=$obj->data->counts->posts;
$userID=$obj->data->username;

//Set Default Timezone as UTC
date_default_timezone_set('utc');

//Calculate Today's Date and the Date Created
$today = date('Y-m-d');
$createdat= $obj->data->created_at;

//Calculate how long user has been on ADN
$date1 = new DateTime($createdat);
$date2 = new DateTime($today);
$interval = $date1->diff($date2);

//Calculate posts per day
$ppd = $posts / $interval->days

//For testing floating point rounding.
//$ppd = 100.5

?>

<link rel="stylesheet" type="text/css" href="css/pca.css" />

</head>

<body>
<div id="divMain"> 

  <h1>
    <span id="myData">
      <?php
        echo $obj->data->name;
      ?>
    </span>
  </h1>

  <!--Avatar Image-->
  <img class="avatar" src="<?php echo $obj->data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

  <!--Cover Image-->
  <img class="cover" src="<?php echo $obj->data->cover_image->url; ?>" alt="cover" height="180"/> 

  <!--Search Box-->
  <form name="form1" method="GET" action="">
    <p>
      <input name="id" type="text" id="id" value="<?php echo $id ?>">
      <input type="submit" name="send" id="send" value="Check">
    </p>
  </form>
  
  <!--Account Info-->
  <p class="stats">
  <?php echo $id; ?> is a <?php echo $obj->data->type; ?> with <?php echo $obj->data->counts->posts; ?> posts in <?php echo $interval->days; ?> days. That means that <?php echo $id; ?> has an average of <?php echo round($ppd, 0, PHP_ROUND_HALF_UP); ?> posts per day.
  </p>
  
  <?php 
  if ($ppd < 200) {
  	echo "This is not a spam user.";
  }
  else {
  	echo "This is a spam user.";
  	echo "<br>";
  	if ($obj->data->type = "human") {
  		echo "This user is incorrectly marked as a human. It should be marked as a feed. <br> Do you want to let ADN Support know about this user? <a href='https://alpha.app.net/intent/post/?text=%40adnsupport%20I%20think%20that%20this%20user%20". $id. "%20is%20marked%20incorrectly%20as%20a%20human'>Here's a post template for you to use.</a>";
  	}
  }
  ?>
  
  <p class="credits">
    Built by <a href="https://app.net/charl">@charl<a/>.
    <br>
    Hosted by <a href="http://jvimedia.org">jvimedia.org</a>.
    <br>
    <a href="/">Return to homepage.</a>
  </p>

</div> 
</body>
</html>

<?php 

function percentage($val1, $val2, $precision) 
{
	$division = $val1 / $val2;

	$res = $division * 100;

	$res = round($res, $precision);
	
	return $res;
}

function echo_img($url) {
    echo "<img src=\"$url\" alt=\"
\"/>";  
    } 
    
function linker($at,$id) {
	
	echo "<a href=\"./posts?id=".$id."&".$at."\">";
}
?>