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

  <title>Is <?php echo $id; ?> a spammer?</title>
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
	<div class="col-md-12">
		<h1>
			<?php
				echo $obj->data->name;
			?>
		</h1>

		<h4>
			<?php 
				echo "<a class='url' href=".$obj->data->canonical_url.">@".$obj->data->username."</a>" 
			?>
		</h4>

		<!--Avatar Image-->
		<img class="avatar" src="<?php echo $obj->data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

		<!--Cover Image-->
		<img class="cover" src="<?php echo $obj->data->cover_image->url; ?>" alt="cover" height="180"/> 

		<br><br>

		<!--Search Box-->
		<div class="row">
	        <form role="form">
	          <div class="col-xs-2">
	            <input type='text' class="form-control" name='id' id="id" value="<?php echo $id; ?>"/>
	          </div>
	            <button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
	        </form>
      	</div>

	</div>
  
	<div class="col-md-6">
		<p class="stats">
			<?php 
				echo $id; 
				echo " is a ";
				echo $obj->data->type;
				echo " with ";
				echo $obj->data->counts->posts;
				echo " posts in ";
				echo $interval->days;
				echo " days. That means that ";
				echo $id;
				echo " has an average ";
				echo round($ppd, 2);
				echo " posts per day.";
			?> 

			<br><br>

			<?php 
				if ($ppd < 200) {
					echo "This is not a spam user.";
				}
				else {
					echo "This is a spam user.";
					echo "<br><br>";
					if ($obj->data->type = "human") {
						echo "This user is incorrectly marked as a human. It should be marked as a feed. <br> Do you want to let ADN Support know about this user? <a href='https://alpha.app.net/intent/post/?text=%40adnsupport%20I%20think%20that%20this%20user%20". $id. "%20is%20marked%20incorrectly%20as%20a%20human'>Here's a post template for you to use.</a>";
					}
				}
			?>
		</p>
	</div>
	<!-- footer.php -->
	<?php include "include/posts_footer.php"; ?>
</div> 
</body>
</html>

<?php 
  function echo_img($url) {
    echo "<img src=\"$url\" alt=\"\"/>";  } 
      
  function linker($at,$id) {
  	echo "<a href=\"./posts?id=".$id."&".$at."\">";}
?>