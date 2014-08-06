<?php
    require_once '../phplib/ControlAppDotNet.php'; // get the EZAppDotNet.php library

    $app = new EZAppDotNet();

    $user_params = array(
        'include_user_annotations' => false, 
    );

    // check that the user is signed in
    if ($app->getSession()) {
		
		// get the authorised user's data
		$auth_user_data = $app->getUser();
        $auth_username = $auth_user_data['username'];

        // do some preparation for later code
		$data_1 = $auth_user_data;
		$user_number_1 = $data_1['id'];
				
	    // declare headers
	    $title = "Following Comparison Tool"; 
        include('../static/headers/header_auth.php');

        if (isset($_GET['id']) and !empty($_GET['id'])) {	    
        	// set the user id for the selected user
		    if(!empty($_GET['id'])) {
		      $userID2 = $_GET['id'];
		    }

		    if ($userID2 != $auth_username) {
			    // get the user data for the selected user
	            $userID2 = ltrim($userID2, '@');	           
	            $user_number_2 = $app->getIdByUsername($userID2);
	            $data_2 = $app->getUser($user_number_2, $user_params);
	            $username2 = $data_2['username'];

	            // get the info on the users that the authorised user is following and sort it
		        $following_user_1 = $app->getFollowingIDs($user_number_1);
		        sort($following_user_1);
		        
		        // get the info on the users that the selected user is following and sort it
		        $following_user_2 = $app->getFollowingIDs($user_number_2);
		        sort($following_user_2);
		        
		        // if the user you have selected has more than zero followers
		        if(count($following_user_2) > 0) {	 
		        	// merge the two arrays       	        
			        $merged_array = array_diff(
						array_merge($following_user_1, $following_user_2),
						array_intersect($following_user_2, $following_user_1)
					);

			        $removed_array_1 = array_intersect($following_user_2, $merged_array);
					// sort the merged array
					sort($removed_array_1);
					
					$array_merge = array_merge($following_user_1, $following_user_2);
		        	$array_intersect = array_intersect($following_user_2, $following_user_1);

		        	// merge the two arrays       	        
			        $Amerged_array = array_diff(
						array_merge($following_user_1, $following_user_2),
						array_intersect($following_user_2, $following_user_1)
					);
					sort($Amerged_array);

			        $Aremoved_array_1 = array_intersect($following_user_2, $Amerged_array);
			        sort($Aremoved_array_1);

			        $Aremoved_array_2 = array_intersect($following_user_1, $Amerged_array);
			        sort($Aremoved_array_2);
			        
					// set the array of users to retrieve
					$user_arr = array();
					
					// generate up to 20 random numbers, retrieve them from the user object, add them to the array of users to retrieve
					$n = 1;
					while($n <= 20) {
						$value = mt_rand(0, count($removed_array_1) - 1);
						$add_array = $removed_array_1[$value];
						$user_arr[] = $add_array;
						$n++;
					}
					
					// retrieve the users who we want to display below
					$retrieved_user_ids = $app->getUsers($user_arr); 
?>

<!-- Header -->
<div class="page-header">
	<h4>Following Comparison Tool <span class="label label-primary">New</span></h4>
	<h1>
	  You (that's @<?php echo $data_1['username']; ?>)
	  and
	  @<?php echo $data_2['username']; ?>
	</h1>
</div>

<form role="form">
	<div class="form-group">
		<label for="id"><em>Enter the Second User ID here:</em></label>
		<input type="text" class="form-control" name="id" id="id" placeholder="User ID" value="<?php echo $userID2; ?>"/>
	</div>
	<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
</form>

<br>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="navTabs">
  <li class="active"><a href="#overview" role="tab" data-toggle="tab">Overview</a></li>
  <li><a href="#recommendations" role="tab" data-toggle="tab">Recommendations</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane fade in active" id="overview">
		<br>
		<div class="row">
			<div class="col-sm-6 col-md-6">
				<div class="thumbnail">
					<canvas id="base_compare" style="width: 818px; height: 409px;"></canvas>
					<div class="caption">
						<p>This graph shows you the number of users you follow compared with how many <a href="<?php echo $alpha, $data_2['username']; ?>" target="_blank">@<?php echo $data_2['username']; ?></a> follows.</p>
					</div>
				</div>
				<script>		    
					var base_compareData = [
					    {
							// get the current (auth) user's following count			    	
					        value: <?php echo $data_1['counts']['following']; ?>,
					        color:"#F7464A",
					        highlight: "#FF5A5E",
					        label: "@<?php echo $data_1['username']; ?>'s following count"
					    },
					    {
					        // get the other user's following count
							value : <?php echo $data_2['counts']['following']; ?>,
					        color: "#46BFBD",
					        highlight: "#5AD3D1",
					        label: "@<?php echo $data_2['username']; ?>'s following count"
					    },		
					];
					var base_compareOptions = {
						animateScale: true,
						responsive: true
					}
				    var base_compare = document.getElementById("base_compare").getContext("2d");
					new Chart(base_compare). PolarArea(base_compareData, base_compareOptions);
				</script>
			</div>
			<div class="col-sm-6 col-md-6">
				<div class="thumbnail">
					<canvas id="not_shared" style="width: 818px; height: 409px;"></canvas>
					<div class="caption">
						<p>This graph shows you the number of users that <a href="<?php echo $alpha, $data_2['username']; ?>" target="_blank">@<?php echo $data_2['username']; ?></a> follows that you don't follow, and vice versa.</p>
					</div>
				</div>
				<script>		    
					var not_sharedData = [
					    {
					        value: <?php echo count($Aremoved_array_2); ?>,
					        color:"#F7464A",
					        highlight: "#FF5A5E",
					        label: "users that you follow but @<?php echo $data_2['username']; ?> doesn't"
					    },
					    {
					        // get the other user's following count
							value : <?php echo count($Aremoved_array_1); ?>,
					        color: "#46BFBD",
					        highlight: "#5AD3D1",
					        label: "users that @<?php echo $data_2['username']; ?> follows but you don't"
					    },		
					];
					var not_sharedOptions = {
						animateScale: true,
						responsive: true
					}
				    var not_shared = document.getElementById("not_shared").getContext("2d");
					new Chart(not_shared). PolarArea(not_sharedData, not_sharedOptions);
				</script>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="recommendations">
		<script>
			function myFollow(userid) {
				var element = document.getElementById(userid); 
				
				if (element.getAttribute("status")=="followed"){
					$.get("../phplib/PurplappFollow.php","id="+userid+"&op=uf");
					
					element.setAttribute("status", "true"); 
					element.setAttribute("class", "btn btn-block btn-info"); 
					
					document.getElementById(userid+"_text").innerHTML='Unfollowed';
				} else {
					$.get("../phplib/PurplappFollow.php","id="+userid);
					
					element.setAttribute("class", "btn btn-block btn-success active"); 
					element.setAttribute("status", "followed"); 
					
					document.getElementById(userid+"_text").innerHTML='Succesfully Followed.'; 
				}
				
				//  elementtext.setAttribute("innerHTML", "You already followed!");
			}
		</script>
		<br>
		
		<!-- Information Text -->
		<p class="lead">Here are some random users that <a href="<?php echo $alpha, $data_2['username']; ?>" target="_blank">@<?php echo $data_2['username']; ?></a> follows but you don't. Maybe you want to check them out and give them a follow?</p>
		
		<!-- User Box Display -->
		<?php 
			$displayed_any = false;
			foreach ($retrieved_user_ids as $user) {	
				if ($user['id'] != $user_number_1) {
					$imgData = '<img src="'.$user['avatar_image']['url'].'" class="img-responsive img-rounded full-width avatar-following"/></a>'; 
					
					echo "<div class='panel panel-default'>";
					echo "<div class='panel-body'>";
					echo "<div class='col-md-2'>";
					echo $imgData;
					echo "</div>";
					echo "<div class='col-md-8'>";
					if(isset($user['name'])) {
						echo "<h2>", $user['name'], " <small>@", $user['username'], "</small></h2>";
					}
					if(isset($user['description']['html'])) {
						echo "<p>", $user['description']['html'], "</p>";	
					}
					echo "</div>";
					echo "<div class='col-md-2'>";
					echo '<a href="'.$alpha, $user['username'].'" target="_blank" role="button" class="btn btn-default btn-block">View on Alpha</a>';
					echo '
						<text id="'.$user['id'].'" onclick="myFollow('.$user['id'].');" class="btn btn-primary btn-block">
						<text id="'.$user['id'].'_text">Follow</text>
						</text> 
					';			
					echo "</div>";
					echo "</div>";
					echo "</div>";
					$displayed_any = true;
				} 
			}
			if ($displayed_any != true) {
				echo "<div class='alert alert-warning'>You follow everyone in this random generated list. <strong><a href='#' onclick='reloadPage()' class='alert-link'>Refresh the page</a> or enter another username above.</strong></div>";
			}
		?>
	</div>
</div>

<?php } else { ?>

<!-- Header -->
<div class="page-header">
    <h1>
		Following Comparison Tool <span class="label label-primary">New</span>
    </h1>
</div>

<!--Search Box-->
<form role="form">
	<div class="form-group">
		<label for="id"><em>Enter the Second User ID here:</em></label>
		<input type="text" class="form-control" name="id" id="id" placeholder="User ID" value="<?php echo $userID2; ?>"/>
	</div>
	<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
</form>

<br>

<!-- Alert -->
<div class="alert alert-warning">The user you have selected doesn't follow anyone. <strong>Enter another user above.</strong></div>

<?php } ?>

<?php } else { ?>

<!-- Header -->
<div class="page-header">
    <h1>
		Following Comparison Tool <span class="label label-primary">New</span>
    </h1>
</div>

<!--Search Box-->
<form role="form">
	<div class="form-group">
		<label for="id"><em>Enter the Second User ID here:</em></label>
		<input type="text" class="form-control" name="id" id="id" placeholder="User ID" value="<?php echo $userID2; ?>"/>
	</div>
	<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
</form>

<br>

<!-- Alert -->
<div class="alert alert-warning">You can't do it with your own username! <strong>Enter another user above.</strong></div>

<?php } ?>

<?php } else { ?>   

<!-- Header -->
<div class="page-header">
    <h1>
		Following Comparison Tool <span class="label label-primary">New</span>
    </h1>
</div>

<!--Search Box-->
<form role="form">
	<div class="form-group">
		<label for="id"><em>Enter the Second User ID here:</em></label>
		<input type="text" class="form-control" name="id" id="id" placeholder="User ID" value=""/>
	</div>
	<button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
</form>

<?php
		}
    // if not, redirect to sign in
    } else {
        $title = "Following Comparison Tool";
        include('../static/headers/header_unauth.php');
        $url = $app->getAuthUrl();
		
        echo '<br><a class="btn btn-social btn-adn" href="'.$url.'">
                <i class="fa fa-adn"></i> Sign in with App.net
              </a>';
        echo "<br><br><i><p>We ask to see basic information about you, and to allow us to send and receive the following types of messages: <strong>Broadcast Messages</strong>.<br>However, we do not send Broadcast messages for you. That would be against our moral values.</i></p>";
    }
?>

<?php
    include "../static/footers/footer.php";
?>

<script>
	function reloadPage() {
	    location.reload();
	}

	$(function () {
		$('#navTabs a:first').tab('show')
	})
	
	$('#navTabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	})
</script>