<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);  

    require_once '../ADN_php/EZAppDotNet.php';

    $app = new EZAppDotNet();

    $params = array(
        'include_annotations' => true,
        'channel_types' => 'net.app.core.broadcast',
        'include_inactive' => true,
    );

    $messages_params = array(
    	'include_message_annotations' => true,
    	'include_user_annotations' => false,
    );

    // check that the user is signed in
    if ($app->getSession()) {
    	if(!empty($_GET['id'])) {
	      $channelID = $_GET['id'];
	    } else {
	      $channelID = "34622";
	    }

        $channel_data = $app->getChannel($channelID, $params);

        $channel_messages = $app->getMessages($channelID, $params);

        foreach($channel_data['annotations'] as $annotations){
	    	if (strpos($annotations['type'],"core.broadcast.metadata") != false){
	            $channel_title=$annotations['value']['title'];
	        }
	    }

	    //Header
        $title = "Broadcast Channel Lookup for ".$channel_title."";
        include('../include/header_auth.php');
?>

<?php 
	// print "<pre>"; 
	// print_r($channel_messages); 
	// print "</pre>";
?>

<div class="col-md-12">
    <!-- User Name -->
    <div class="page-header">
        <h4>Broadcast Channel Lookup</h4>
        <h1>
			<?php
				foreach($channel_data['annotations'] as $annotations){
			    	if (strpos($annotations['type'],"core.broadcast.metadata") != false){
			            $channel_title=$annotations['value']['title'];
			            echo $channel_title;
			        }
			    }
			?>
			<small>
			    <?php
					foreach($channel_data['annotations'] as $annotations){
				    	if (strpos($annotations['type'],"core.broadcast.freq") != false){
				            $channel_freq=$annotations['value']['avg_freq'];
				            echo $channel_freq;
			            }
			        }

					foreach($channel_data['annotations'] as $annotations){
				    	if (strpos($annotations['type'],"core.fallback_url") != false){
				            $channel_fallback=$annotations['value']['url'];
				            echo "<a href='".$channel_fallback."' class='label label-default' target='_blank'>Subscribe</a>";
			            }
			        }						
				?>
			</small>
		</h1>
    </div>

    <?php
    	// channel logo image
	    foreach($channel_data['annotations'] as $annotations){
	    	if (strpos($annotations['type'],"core.broadcast.icon") != false){
            	$channel_logo=$annotations['value']['url'];
            	echo "<img src=".$channel_logo." alt='avatar' class='img-rounded' width='120' height='120'/>";
            }
	    }

	    // channel cover image
		foreach($channel_data['annotations'] as $annotations){
	    	if (strpos($annotations['type'],"core.broadcast.cover") != false){
            	$channel_cover=$annotations['value']['url'];
            	echo "<div class='cover'>";
            	echo "<img src=".$channel_cover." alt='cover' height='120'/>";
            	echo "</div>";
            }
        }
    ?>

    <br><br>

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
		    </div>
		</form>
	</div>

	<br>

	<!-- Channel Description -->
	<?php
		foreach($channel_data['annotations'] as $annotations){
	    	if (strpos($annotations['type'],"core.broadcast.metadata") != false){
	            $channel_description=$annotations['value']['description'];
	            echo $channel_description;
            }
        }
    ?>
    <br><br>
</div>

<div class="col-md-4">
    <table class="table">
    	<tr>
    		<td>Messages:</td>
    		<td><?php echo $channel_data['counts']['messages']; ?></td>
    	</tr>
<!--     	<tr>
    		<td>Subscribers:</td>
    		<td><?php echo $channel_data['counts']['subscribers']; ?></td>
    	</tr>    --> 	
    	<tr>
    		<td>Owner:</td>
    		<td><a href="http://alpha.jvimedia.org/<?php echo $channel_data['owner']['username']; ?>">@<?php echo $channel_data['owner']['username']; ?></a></td>
    	</tr>    	
    </table>
</div>

<div class="col-md-8">
	<?php
		foreach ($channel_messages as $messages) {
			if (isset($messages['is_deleted'])) {
				echo "<div class='panel panel-default'>";
		  			echo "<div class='panel-body'>";
						echo "Deleted Message";
					echo "</div>";
				echo "</div>";				
			} else {
				echo "<div class='panel panel-default'>";
					foreach($messages['annotations'] as $message_annotations){
				    	if (strpos($message_annotations['type'],"core.broadcast.message.metadata") != false){
			            	$post_title=$message_annotations['value']['subject'];
			            	echo "<div class='panel-heading'>";
							echo "<h3 class='panel-title'>";
			            	echo $post_title;
			            	echo "</h3>";
							echo "</div>";		            	
			            }
			        }
		  			echo "<div class='panel-body'>";
						echo $messages['html'];

						$imgData = "";

						foreach ($messages['annotations'] as $annotkey => $annot){
					      if ($annot['type']==='net.app.core.oembed'){
					        $imgData = '<br><br><img src="'.$annot['value']['url'].'" class="img-responsive img-rounded full-width"/></a>'; 
					      }
					    }

					    echo $imgData;
					echo "</div>";
					echo "<div class='panel-footer'>";
						$created_at = new DateTime($messages['created_at']);
						$date_message_created = $created_at->format('Y-m-d H:i:s');
						echo $date_message_created;
						foreach($messages['annotations'] as $message_annotations){
					    	if (strpos($message_annotations['type'],"core.crosspost") != false){
								$post_crosspost=$message_annotations['value']['canonical_url'];
								echo "&nbsp - &nbsp<a class='url' href='".$post_crosspost."'>Read more on ".parse_url($post_crosspost, PHP_URL_HOST)."</a>";
							}
						}
					echo "</div>";
				echo "</div>";
			}
		}
	?>
</div>


<?php include "../include/footer.php"; ?>

<?php
    // if not, redirect to sign in
    } else {
        $title = "User Information Lookup";
        include('../include/header_unauth.php');

        echo '<a href="../ADN_php/login.php"><h2>Sign in using App.net</h2></a>';
    }
?>	    