<?php
    require_once '../phplib/ControlAppDotNet.php'; // get the EZAppDotNet.php library

    $app = new EZAppDotNet();

    $user_params = array(
        'include_user_annotations' => true, 
    );

    // check that the user is signed in
    if ($app->getSession()) {
	    // get the authorised user's data
	    $auth_user_data = $app->getUser();
	    $auth_username = $auth_user_data['username'];

	    // get headers
	    $title = "First Mentions Lookup"; 
        include('../static/headers/header_auth.php');

        if (isset($_GET['id1']) and isset($_GET['id1'])) {
	    	if(!empty($_GET['id1'])) {
		      $userID1 = $_GET['id1'];
		    } else {
		      $userID1 = "me";
		    }

		    if(!empty($_GET['id2'])) {
		      $userID2 = $_GET['id2'];
		    } else {
		      $userID2 = "me";
		    }

		    if ($userID1 == 'me') {
                $data_1 = $app->getUser('me', $user_params);
	            $user_number_1 = $data_1['id'];
	            $username1 = $data_1['username'];
	        } else {
	            $userID1 = ltrim($userID1, '@');           
	            $user_number_1 = $app->getIdByUsername($userID1);
	            $data_1 = $app->getUser($user_number_1, $user_params);
	            $username1 = $data_1['username'];
	        }

	        if ($userID2 == 'me') {
	            $data_2 = $app->getUser('me', $user_params);
	            $user_number_2 = $data_2['id'];
	            $username2 = $data_2['username'];
	        } else {
	            $userID2 = ltrim($userID2, '@');	           
	            $user_number_2 = $app->getIdByUsername($userID2);
	            $data_2 = $app->getUser($user_number_2, $user_params);
	            $username2 = $data_2['username'];
	        }

	        // get mentions of user 1 by user 2
	        $mentions_params_1 = array(
	        	'mentions' => $username1,
	        	'creator_id' => $user_number_2,
	        	'include_post_annotations' => true,
	        	'count' => '-1',
	        );
	        $mentions_user_1 = $app->searchPosts($mentions_params_1);

	        // get mentions of user 2 by user 1
	        $mentions_params_2 = array(
	        	'mentions' => $username2,
	        	'creator_id' => $user_number_1,
	        	'include_post_annotations' => true,
	        	'count' => '-1',
	        );
	        $mentions_user_2 = $app->searchPosts($mentions_params_2);
?>

<div class="col-md-12">
<!-- User Name -->
	<div class="page-header">
		<h4>Check First Mention Between... <!-- <span class="label label-primary">New</span> --></h4>
		<h1>
		  <?php echo htmlentities($data_1['name']); ?>
		  and
		  <?php echo htmlentities($data_2['name']); ?>
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
		<p class="help-block">Does not work correctly for accounts who have changed username.</p>
		<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
	</form>

	<br>

	<!-- User 1 Mentioning 2 Display -->
	<?php if (isset($mentions_user_2)) { ?>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'>First mention of <?php echo $userID2; ?> by <?php echo $userID1; ?>:</h3>
			</div>
			<div class='panel-body'>
				<?php 
					echo $mentions_user_2[0]['html'];
					
					$imgData2 = "";

					foreach ($mentions_user_2[0]['annotations'] as $annotkey => $annot){
				      if ($annot['type']==='net.app.core.oembed'){
				        $imgData2 = '<br><br><img src="'.$annot['value']['url'].'" class="img-responsive img-rounded full-width"/></a>'; 
				      }
				    }

				    echo $imgData2;			
				?>
			</div>
			<div class='panel-footer'>
				<?php
					$created_at_2 = new DateTime($mentions_user_2[0]['created_at']);
					$date_message_created_2 = $created_at_2->format('Y-m-d H:i:s');

					echo "<a class='url' href=".$mentions_user_2[0]['canonical_url']." target='_blank'><i class='fa fa-clock-o fa-fw'></i>".$date_message_created_2."</a>";
					if (isset($mentions_user_2[0]['reply_to'])) {
						echo "&nbsp - &nbsp";
						echo "<a class='url' href='".$mentions_user_2[0]['canonical_url']."#".$mentions_user_2[0]['reply_to']."' target='_blank''><i class='fa fa-comments fa-fw'></i></a>";
					} else {}
					echo "&nbsp - &nbsp";
					echo "<a class='url' href=".$mentions_user_2[0]['source']['link']." target='_blank'><i class='fa fa-external-link fa-fw'></i> via ".$mentions_user_2[0]['source']['name']."</a>";
				?>
			</div>
		</div>
	<?php } ?>

	<!-- User 2 Mentioning 1 Display -->
	<?php if (isset($mentions_user_1)) { ?>
		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'>First mention of <?php echo $userID1; ?> by <?php echo $userID2; ?>:</h3>
			</div>
			<div class='panel-body'>
				<?php 
					echo $mentions_user_1[0]['html'];
					
					$imgData1 = "";

					foreach ($mentions_user_1[0]['annotations'] as $annotkey => $annot){
				      if ($annot['type']==='net.app.core.oembed'){
				        $imgData1 = '<br><br><img src="'.$annot['value']['url'].'" class="img-responsive img-rounded full-width"/></a>'; 
				      }
				    }

				    echo $imgData1;			
				?>
			</div>
			<div class='panel-footer'>
				<?php
					$created_at_1 = new DateTime($mentions_user_1[0]['created_at']);
					$date_message_created_1 = $created_at_1->format('Y-m-d H:i:s');

					echo "<a class='url' href=".$mentions_user_1[0]['canonical_url']." target='_blank'><i class='fa fa-clock-o fa-fw'></i>".$date_message_created_1."</a>";
					if (isset($mentions_user_1[0]['reply_to'])) {
						echo "&nbsp - &nbsp";
						echo "<a class='url' href='".$mentions_user_1[0]['canonical_url']."#".$mentions_user_1[0]['reply_to']."' target='_blank''><i class='fa fa-comments fa-fw'></i></a>";
					} else {}
					echo "&nbsp - &nbsp";
					echo "<a class='url' href=".$mentions_user_1[0]['source']['link']." target='_blank'><i class='fa fa-external-link fa-fw'></i> via ".$mentions_user_1[0]['source']['name']."</a>";
				?>
			</div>
		</div>
	<?php } ?>
</div>

<?php } else { ?>   

<div class="col-md-12">
    <!-- User Name -->
    <div class="page-header">
	    <h1>
		    First Mention Lookup
        </h1>
    </div>

    <!--Search Box-->
	<form role="form">
		<div class="form-group">
			<label for="id1"><em>Enter the First User ID here:</em></label>
			<input type="text" class="form-control" name="id1" id="id1" placeholder="User ID 1" value=""/>
		</div>
		<div class="form-group">
			<label for="id2"><em>Enter the Second User ID here:</em></label>
			<input type="text" class="form-control" name="id2" id="id2" placeholder="User ID 2" value=""/>
		</div>
		<p class="help-block">Does not work for accounts who have changed username.</p>
		<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
	</form>
</div>

<?php
		}
    // if not, redirect to sign in
    } else {
        $title = "First Mentions Lookup";
        include('../static/headers/header_unauth.php');
        $url = $app->getAuthUrl();
		
        echo "<div class='container'>";
        echo '<br><a class="btn btn-social btn-adn" href="'.$url.'">
                <i class="fa fa-adn"></i> Sign in with App.net
              </a>';
        echo "<br><br><i><p>We ask to see basic information about you, and to allow us to send and receive the following types of messages: <strong>Broadcast Messages</strong>.<br>However, we do not send Broadcast messages for you. That would be against our moral values.</i></p>";
        echo "</div>";
    }
    include "../static/footers/footer.php";
?>