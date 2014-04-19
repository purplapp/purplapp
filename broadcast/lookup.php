<?php 
	// error_reporting(E_ALL);
	// ini_set("display_errors", 1);   

	//Required files
	require('../config.php');
	require('lookup.class.php');
	
	if(!empty($_GET['id'])) {
      $channelID = $_GET['id'];
    } else {
      $channelID = "34622";
    }

	//Set Default Timezone
	date_default_timezone_set('UTC');
	
	//Pulling From lookup.class.php and interpreting
	$lookup = new Lookup;
	
	$lookup->setChannelID($channelID);
	$lookup->getBroadcastChannel();
	$lookup->getBroadcastPosts();
	
	$channel_lookup = $lookup->channel_info;
	$channel_posts = $lookup->channel_posts;
	$channel_annotations = $lookup->channel_info->annotations;

	foreach($channel_annotations as $channel_annotationsC){
        $type = $channel_annotationsC->type;
    	if (strpos($type,"core.broadcast.metadata") != false){
            $channel_title=$channel_annotationsC->value->title;
        }
    }

	$title = "Broadcast Channel Lookup for ".$channel_title.""; 
	include('../include/header.php');
?>

<?php if($lookup->getBroadcastChannel() !== false) { ?>
<div class="col-md-12">
<!--   	<?php 
		print "<pre>"; 
		print_r($channel_lookup); 
		print "</pre>";
    ?>   -->
    
	<div class="page-header">
		<h4>Broadcast Channel Lookup <span class="label label-primary">New</span></h4>
		<h1>
			<?php
				foreach($channel_annotations as $channel_annotationsC){
		            $type = $channel_annotationsC->type;
		        	if (strpos($type,"core.broadcast.metadata") != false){
			            $channel_title=$channel_annotationsC->value->title;
			            echo $channel_title;
			        }
			    }
			?>
			<small>
			    <?php
					foreach($channel_annotations as $channel_annotationsC){
			            $type = $channel_annotationsC->type;
			        	if (strpos($type,"core.broadcast.freq") != false){
				            $channel_freq=$channel_annotationsC->value->avg_freq;
				            echo $channel_freq;
			            }
			        }
			    ?>
				<?php
					foreach($channel_annotations as $channel_annotationsC){
			            $type = $channel_annotationsC->type;
			        	if (strpos($type,"core.fallback_url") != false){
				            $channel_fallback=$channel_annotationsC->value->url;
				            echo "<a href='".$channel_fallback."' class='label label-default' target='_blank'>Subscribe</a>";
			            }
			        }						
				?>
			</small>
		</h1>
	</div>

    <!--Channel Logo Image-->
    <?php
	    foreach($channel_annotations as $channel_annotationsC){
            $type = $channel_annotationsC->type;
            if (strpos($type,"core.broadcast.icon") != false){
            	$channel_logo=$channel_annotationsC->value->url;
            	echo "<img src=".$channel_logo." alt='avatar' class='img-rounded' width='120' height='120'/>";
            }
	    }
    ?>

    <!-- Channel Cover Image -->
	<?php 
		foreach($channel_annotations as $channel_annotationsC){
            $type = $channel_annotationsC->type;
            if (strpos($type,"core.broadcast.cover") != false){
            	$channel_cover=$channel_annotationsC->value->url;
            	echo "<div class='cover'>";
            	echo "<img src=".$channel_cover." alt='cover' height='120'/>";
            	echo "</div>";
            }
        }
    ?>
	
	<!--Search Box-->
	<div class="row">
		<form role="form" class="form-inline">
		    <div class="col-lg-3">
	      	  <p><em>Enter the Channel ID here:</em></p>
		      <div class="input-group">
		        <input type="text" class="form-control" name="id" id="id" placeholder="Channel ID" value="<?php echo $channelID; ?>"/>
		        <span class="input-group-btn">
		          <button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
		        </span>
		      </div>
		      <span class="help-block">Please enter the Channel ID - the five numbers which you can find in the Broadcast URL.</span>
		    </div>
		</form>
	</div>

	<br>

	<!-- Channel Description -->
	<?php
		foreach($channel_annotations as $channel_annotationsC){
            $type = $channel_annotationsC->type;
        	if (strpos($type,"core.broadcast.metadata") != false){
	            $channel_description=$channel_annotationsC->value->description;
	            echo $channel_description;
            }
        }
    ?>

	<br><br>

	<?php
		$type = $channel_annotationsC->type;
        if (strpos($type,"core.broadcast.metadata") != false){
			foreach ($channel_posts as $channel_postsC) {
			    $created_at = new DateTime($channel_postsC->created_at);
	    		$date_message_created = $created_at->format('Y-m-d H:i:s');

				echo "<div class='panel panel-default'>";
					$channel_posts_annotations = $channel_postsC->annotations;
					foreach($channel_posts_annotations as $channel_posts_annotationsC){
			            $type = $channel_posts_annotationsC->type;
			            if (strpos($type,"core.broadcast.message.metadata") != false){
			            	$post_title=$channel_posts_annotationsC->value->subject;
			            	echo "<div class='panel-heading'>";
							echo "<h3 class='panel-title'>";
			            	echo $post_title;
			            	echo "</h3>";
							echo "</div>";		            	
			            }
			        }
		  			echo "<div class='panel-body'>";
						echo $channel_postsC->html;
					echo "</div>";
					echo "<div class='panel-footer'>";
						echo $date_message_created;
						foreach($channel_posts_annotations as $channel_posts_annotationsC){
				            $type = $channel_posts_annotationsC->type;
							if (strpos($type,"core.crosspost") != false){
								$post_crosspost=$channel_posts_annotationsC->value->canonical_url;
								echo "&nbsp - &nbsp<a class='url' href='".$post_crosspost."'>Read more on ".parse_url($post_crosspost, PHP_URL_HOST)."</a>";
							}
						}
					echo "</div>";
				echo "</div>";
			}
		} else {
			echo "Data not loaded: this channel doesn't exist or isn't marked as a Broadcast channel. <a href=\"javascript:history.go(-1)\">Go back to the previous page.</a>";
		}
	?>
</div>
<?php } else { echo "Data not loaded: this channel doesn't exist or isn't marked as a Broadcast channel. <a href=\"javascript:history.go(-1)\">Go back to the previous page.</a>"; } ?>
<?php include('../include/footer.php'); ?>