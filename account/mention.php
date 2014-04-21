<?php 
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);   

	//Required files
	require('../config.php');
	require('mention.class.php');
	
	if(!empty($_GET['id1'])) {
      $userID1 = $_GET['id1'];
    } else {
      $userID1 = "charl";
    }

    if(!empty($_GET['id2'])) {
      $userID2 = $_GET['id2'];
    } else {
      $userID2 = "redqueencoder";
    }

	//Set Default Timezone
	date_default_timezone_set('UTC');
	
	//Pulling From lookup.class.php and interpreting
	$mention = new Mention;
	
	$mention->setUserID1($userID1);
	$mention->setUserID2($userID2);
	$mention->getUserInfo1();
	$mention->getUserInfo2();
	$mention->getMention1to2();
	$mention->getMention2to1();

	$user_1_info = $mention->user_info_1;
	$user_2_info = $mention->user_info_2;
	$user1_mentions2 = $mention->usermention1to2;
	$user2_mentions1 = $mention->usermention2to1;
	$user1_mentions2_annotations = $mention->usermention1to2annot;
	$user2_mentions1_annotations = $mention->usermention2to1annot;

	$created_at_1 = new DateTime($user1_mentions2->created_at);
    $date_message_created_1 = $created_at_1->format('Y-m-d H:i:s');

    $created_at_2 = new DateTime($user2_mentions1->created_at);
    $date_message_created_2 = $created_at_2->format('Y-m-d H:i:s');

    $title = "First Mentions Lookup for ".$userID1." and ".$userID2.""; 
	include('../include/header.php');
?>

<div class="col-md-12">
<!-- 	<?php 
		print "<pre>"; 
		print_r($user1_mentions2_annotations); 
		print "</pre>";
    ?> -->

    <em><a href="/account.php"><i class="fa fa-chevron-left fa-fw"></i>Go Back</a></em>

    <!-- User Name -->
	<div class="page-header">
		<h4>Check First Mention Between... <span class="label label-primary">New</span></h4>
		<h1>
		  <?php echo $user_1_info->name ?>
		  and
		  <?php echo $user_2_info->name ?>
		</h1>
	</div>

	<!--Search Box-->
	<form role="form">
		<div class="form-group">
			<label for="id1"><em>Enter the First User ID here:</em></label>
			<input type="text" class="form-control" name="id1" id="id1" placeholder="User ID 1" value="<?php echo $userID1; ?>"/>
		</div>
		<div class="form-group">
			<label for="id2"><em>Enter the Second User ID here:</em></label>
			<input type="text" class="form-control" name="id2" id="id2" placeholder="User ID 2" value="<?php echo $userID2; ?>"/>
		</div>
		<p class="help-block">Does not work for accounts who have changed username.</p>
		<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
	</form>

	<br>

	<!-- Post 1 Mentioning 2 Display -->
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h3 class='panel-title'>First mention of <?php echo $userID1; ?> by <?php echo $userID2; ?>:</h3>
		</div>
		<div class='panel-body'>
			<?php 
				echo $user1_mentions2->html;
				foreach ($user1_mentions2_annotations as $oembedC) {
					$type = $oembedC->type;
					if (strpos($type,"core.oembed")) {
						$oembed_image_1 = $oembedC->value->thumbnail_large_url_immediate;
						echo "<img class='img-responsive' src=".$oembed_image_1." alt='embedded image'>";
					}
				}				
			?>
		</div>
		<div class='panel-footer'>
			<?php
				echo "<a class='url' href=".$user1_mentions2->canonical_url." target='_blank'><i class='fa fa-clock-o fa-fw'></i>".$date_message_created_1."</a>";
				if ($user1_mentions2->reply_to) {
					echo "&nbsp - &nbsp";
					echo "<a class='url' href='".$user1_mentions2->canonical_url."#".$user1_mentions2->reply_to." target='_blank''><i class='fa fa-comments fa-fw'></i></a>";
				} else {}
				echo "&nbsp - &nbsp";
				echo "<a class='url' href=".$user1_mentions2->source->link." target='_blank'><i class='fa fa-external-link fa-fw'></i> via ".$user1_mentions2->source->name."</a>";
			?>
		</div>
	</div>

	<!-- Post 2 Mentioning 1 Display -->
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h3 class='panel-title'>First mention of <?php echo $userID2; ?> by <?php echo $userID1; ?>:</h3>
		</div>
		<div class='panel-body'>
			<?php 
				echo $user2_mentions1->html;
				foreach ($user2_mentions1_annotations as $oembedC2) {
					$type = $oembedC2->type;
					if (strpos($type,"core.oembed")) {
						$oembed_image_2 = $oembedC2->value->thumbnail_large_url_immediate;
						echo "<img class='img-responsive' src=".$oembed_image_2." alt='embedded image'>";
					}
				}				
			?>
		</div>
		<div class='panel-footer'>
			<?php
				echo "<a class='url' href=".$user2_mentions1->canonical_url." target='_blank'><i class='fa fa-clock-o fa-fw'></i>".$date_message_created_2."</a>";
				if ($user2_mentions1->reply_to) {
					echo "&nbsp - &nbsp";
					echo "<a class='url' href='".$user2_mentions1->canonical_url."#".$user2_mentions1->reply_to." target='_blank''><i class='fa fa-comments fa-fw'></i></a>";
				} else {}
				echo "&nbsp - &nbsp";
				echo "<a class='url' href=".$user2_mentions1->source->link." target='_blank'><i class='fa fa-external-link fa-fw'></i> via ".$user2_mentions1->source->name."</a>";
			?>
		</div>
	</div>
</div>
<?php include('../include/footer.php'); ?>