<?php
//    error_reporting(E_ALL);
//    ini_set("display_errors", 1);  

    require_once '../ADN_php/EZAppDotNet.php';
    require('../ADN_php/newFunctions.php');
    require('../ADN_php/nicerank.php');
        
    $app = new EZAppDotNet();

    $user_params = array(
        'include_user_annotations' => true, 
    );
    
    //calculate current date for day calc
    $today = date('Y-m-d H:i:s');
    $start = new DateTime($today);

    // check that the user is signed in
    if ($app->getSession()) {
        if(!empty($_GET['id'])) {
            $username = $_GET['id'];
        } else {
            $username = "me";
        }

        $auth_user_data = $app->getUser();
        $auth_username = $auth_user_data['username'];

        //Header
        $title = "User Information Lookup";
        include('../include/header_auth.php');

        if ($username == 'me') {
            try {
                $data = $app->getUser('me', $user_params);
            } catch(AppDotNetException $x) {
                echo 'Caught exception: ', $x->getMessage(), "\n"; 
            }

            $user_number = $data['id'];

            $username = $data['username'];

        } else {
            $username = ltrim($username, '@');
            
            $user_number = $app->getIdByUsername($username);
            $data = $app->getUser($user_number, $user_params);

        }
        
        //calculate date created for day calc
        $createdat= new DateTime($data['created_at']);
        $adnjoin = $createdat->format('Y-m-d H:i:s');

        //calculate number of days on ADN
        $date1 = new DateTime($adnjoin);
        $date2 = new DateTime($today);
        $interval = $date1->diff($date2);
		
		// pca club functions
        $clubs = new PostClubs;
		
		$clubs->setAlpha($alpha);
        $clubs->setUserPost($data['counts']['posts']);
        $clubs->getClubs();

        $user_clubs = $clubs->memberclubs;
        
		// post-date functions
		$posts = new PostData;
		
		// nicerank
		$nicerank = new NiceRank;
		
		$nicerank->setUserID($user_number);
		$nicerank->getNiceRank();
		
		$nice_rank_data = $nicerank->nicerank;
?>

<div class="col-md-12">
    <!-- User Name -->
    <div class="page-header">
        <h4>User Lookup</h4>
        <h1>
          <?php echo $data['name'] ?>
          <small>
            <?php echo "<a href='".$alpha, $data['username']."' target='_blank'>@".$data['username']."</a>" ?>
          </small>
        </h1>
    </div>

    <!--Avatar Image-->
    <?php echo "<img class='avatar' src=".$data['avatar_image']['url']." alt='avatar' width='180' height='180'/>"; ?> 

    <!--Cover Image-->
    <div class="cover">
        <?php echo "<img class='cover' src=".$data['cover_image']['url']." alt='cover' height='180'/>"; ?> 
    </div>

    <br><br>

    <!--Search Box-->
    <div class="row">
        <form role="form" class="form-inline">
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="id" id="id" value="<?php echo $username; ?>"/>
                    <span class="input-group-btn">
                        <button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
                    </span>
                </div>
            </div>
        </form>
    </div>

    <br>

    <!--User Bio-->
    <p class="bio">
        <?php echo $data['description']['html']; ?>
    </p>
</div>

<div class="col-md-6">
    <!--Info-->
    <table class="table table-condensed">
        <tr>
            <td><h4>ADN Data</h4></td>
            <td></td>
        </tr>
        <tr>
            <td>Posts:</td>
            <td><?php echo "<a class='url' href='".$alpha, $data['username']."/posts/' target='_blank'>".$data['counts']['posts']."</a> <i>(average ".round(($data['counts']['posts'] / $interval->days), 2)." per day)</i>"; ?></td>
        </tr>
        <tr>
            <td>Starred:</td>
            <td><?php echo "<a class='url' href='".$alpha, $data['username']."/stars/' target='_blank'>".$data['counts']['stars']."</a> <i>(average ".round(($data['counts']['stars'] / $interval->days), 2)." per day)</i>"; ?></td>
        </tr>
        <?php if ($username != $auth_username) { ?>
        <tr>
            <td>Following:</td>
            <td>
            	<?php
            		if ($data['follows_you']){ $follows_you = "follows you"; } else { $follows_you = "does not follow you"; }
            		echo "<a class='url' href='".$alpha, $data['username']."/following/' target='_blank'>".$data['counts']['following']."</a> <i>(".$follows_you.")</i>" 
            	?>
            </td>
        </tr>
        <tr>
            <td>Followers:</td>
            <td>
            	<?php
            		if ($data['you_follow']){ $you_follow = "you follow"; } else { $you_follow = "you don't follow"; }
            		echo "<a class='url' href='".$alpha, $data['username']."/followers/' target='_blank'>".$data['counts']['followers']."</a> <i>(".$you_follow.")</i>" 
            	?>
            </td>
        </tr>

		<?php } else { ?>
        <tr>
            <td>Following:</td>
            <td><?php echo "<a class='url' href='".$alpha, $data['username']."/following/' target='_blank'>".$data['counts']['following']."</a>" ?></td>
        </tr>
        <tr>
            <td>Followers:</td>
            <td><?php echo "<a class='url' href='".$alpha, $data['username']."/followers/' target='_blank'>".$data['counts']['followers']."</a>" ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td>Account Type:</td>
            <td><?php echo ucfirst($data['type']); ?></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td><?php echo $data['timezone']; ?></td>
        </tr>
        <tr>
            <td>Locale:</td>
            <td><?php echo $data['locale']; ?></td>
        </tr>
        <tr>
            <td>User Number:</td>
            <td><?php echo $data['id']; ?></td>
        </tr>
        <tr>
            <td>Joined:</td>
            <td>
                <?php
                    $date = new DateTime($data['created_at']);
                    $dateresult = $date->format('H:i \o\n d M Y');
                    
                    $end = new DateTime($adnjoin);
			        $adnage = $posts->formatDateDiff($start, $end);
					
					echo $dateresult, " <i>(", $adnage, " ago)</i>";
                ?>
            </td>
        </tr>
        <?php 
            if(isset($data['verified_link'])) {
                $verified_link = "y";
            } else {
                $verified_link = "n";
            }
	        if (($verified_link = "y") and $data['annotations']) { 
        ?>
        <tr>
            <td><h4>User Data</h4></td>
            <td></td>
        </tr>
        <tr>
            <?php
            if (isset($data['verified_link'])) {
                $verified_link = $data['verified_link'];
                echo "<td>Verified Domain:</td>";
                echo "<td>";
                echo "<a href='".$verified_link."' target='_blank'>".$data['verified_domain']."</a>";
                echo "</td>";
            }
            ?>
        </tr>    
        <tr>
            <?php
            foreach($data['annotations'] as $annotations){
                if (strpos($annotations['type'],"core.directory.blog") == true){
                    $blogurl=$annotations['value']['url'];
                    echo "<td>Blog:</td>";
                    echo "<td>";
                    echo "<a href=".$blogurl." target='_blank'>".parse_url($blogurl, PHP_URL_HOST)."</a>";
                    echo "</td>"; 
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach($data['annotations'] as $annotations){
                if (strpos($annotations['type'],"core.directory.facebook") == true){
                    $facebook_id=$annotations['value']['id'];
                    echo "<td>Facebook:</td>";
                    echo "<td>";
                    echo '<a href="http://facebook.com/'.$facebook_id.'" target="_blank">'.$facebook_id.'</a>';
                    echo "</td>"; 
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach($data['annotations'] as $annotations){
                if (strpos($annotations['type'],"core.directory.twitter") == true){
                    $twitter_id=$annotations['value']['username'];
                    echo "<td>Twitter:</td>";
                    echo "<td>";
                    echo '<a href="http://twitter.com/'.$twitter_id.'" target="_blank">@'.$twitter_id.'</a>';
                    echo "</td>"; 
                }
            }
            ?>
        </tr>    
        <tr>
            <?php
            foreach($data['annotations'] as $annotations){
                if (strpos($annotations['type'],"appnetizens.userinput.gender") == true){
                    $gender=$annotations['value']['gender'];
                    echo "<td>Gender:</td>";
                    echo "<td>";
                    echo ucwords($gender);
                    echo "</td>"; 
                }
            }
            ?>
        </tr>
        <tr>
            <?php
            foreach($data['annotations'] as $annotations){
                if (strpos($annotations['type'],"appnetizens.userinput.birthday") == true){
                    $birthday=$annotations['value']['birthday'];
                    echo "<td>Birthday:</td>";
                    echo "<td>";
                    echo $birthday;
                    echo "</td>"; 
                }
            }
            ?>
        </tr>
        <?php } ?>       
    </table>
</div>

<div class="col-md-6">
    <table class="table table-condensed">
        <?php if ($username != $auth_username) { ?>
        <tr>
            <td><h4>Comparison</h4></td>
            <td></td>
        <tr>
            <td class="">Muted:</td>
            <td><?php if ($data['you_muted']){ echo "Yes"; } else { echo "No"; } ?></td>
        </tr>
        <tr>
            <td class="">Blocked:</td>
            <td><?php if ($data['you_blocked']){ echo "Yes"; } else { echo "No"; } ?></td>
        </tr>
        <?php } ?>
        <?php if ($data['counts']['posts'] > '0') { ?>
        <tr>
            <td><h4>Post Data</h4></td>
            <td></td>
        </tr>
        <tr>
            <td class="">First Post:</td>
            <td>
                <?php 
                    $post_params = array(
                      'count' => '-1',
                    );

                    $firstpost = $app->getUserPosts($user_id="$user_number", $post_params);

                    $created_at = new DateTime($firstpost[0]['created_at']);
                    $firstpost_created_at = $created_at->format('H:i \o\n d M Y');

                    $firstpost_post_id = $firstpost[0]['id'];
                    $firstpost_user = $firstpost[0]['user']['username'];
                ?>
                <a href="<?php echo $alpha, $firstpost_user, "/post/", $firstpost_post_id; ?>" target="_blank"><?php echo $firstpost_created_at; ?></a>
            </td>
        </tr>

        <?php
            $mention_params = array(
              'count' => '-1',
            );

            $firstmention = $app->getUserMentions($user_id="$user_number", $mention_params);

            if ($firstmention) {
                $created_at = new DateTime($firstmention[0]['created_at']);
                $firstmention_created_at = $created_at->format('H:i \o\n d M Y');

                $firstmentionlink = $firstmention[0]['canonical_url'];

                $firstmention_user = $firstmention[0]['user']['username'];
                $firstmention_user_link = $firstmention[0]['user']['canonical_url'];
                
                $firstmention_post_id = $firstmention[0]['id'];               
        ?>
        <tr>
            <td class="">First Mention:</td>
            <td>
                <a href="<?php echo $alpha, $firstmention_user, "/post/", $firstmention_post_id; ?>" target='_blank'><?php echo $firstmention_created_at; ?></a> <i>(by <a href="http://alpha.jvimedia.org/<?php echo $firstmention_user; ?>" target='_blank'>@<?php echo $firstmention_user; ?>)</i></a>
            </td>
        </tr>               
        <?php } ?>

        <tr>
            <td>Last Post:</td>
            <td>
                <?php 
                    $last_post_params = array(
                      'count' => '1',
                    );

                    $lastpost = $app->getUserPosts($user_id="$user_number", $last_post_params);

                    $created_at = new DateTime($lastpost[0]['created_at']);
                    $lastpost_created_at = $created_at->format('Y-m-d H:i:s');

                    $lastpostlink = $lastpost[0]['canonical_url'];
                    
                    $end = new DateTime($lastpost_created_at);
			        $lastpost_ago = $posts->formatDateDiff($start, $end);	

			        $lastpost_post_id = $lastpost[0]['id'];
                    $lastpost_user = $lastpost[0]['user']['username'];	        
                ?>
                <a href="<?php echo $alpha, $lastpost_user, "/post/", $lastpost_post_id; ?>" target='_blank'><?php echo $lastpost_ago; ?> ago</a>
            </td>
        </tr>

        <?php
            $last_mention_params = array(
              'count' => '1',
            );

            $lastmention = $app->getUserMentions($user_id="$user_number", $last_mention_params);

            if ($lastmention) {
                $created_at = new DateTime($lastmention[0]['created_at']);
                $lastmention_created_at = $created_at->format('Y-m-d H:i:s');

                $lastmentionlink = $lastmention[0]['canonical_url'];

                $lastmention_user = $lastmention[0]['user']['username'];
                $lastmention_user_link = $lastmention[0]['user']['canonical_url'];
                
                $end = new DateTime($lastmention_created_at);
		        $lastmention_ago = $posts->formatDateDiff($start, $end);

                $lastmention_post_id = $lastmention[0]['id'];               		        
        ?>
        <tr>
            <td class="">Last Mention:</td>
            <td>
                <a href="<?php echo $alpha, $lastmention_user, "/post/", $lastmention_post_id; ?>" target='_blank'><?php echo $lastmention_ago; ?> ago</a> <i>(by <a href="http://alpha.jvimedia.org/<?php echo $lastmention_user; ?>" target='_blank'>@<?php echo $lastmention_user; ?>)</i></a>
            </td>
        </tr>           
        <?php } ?>
         
        <?php } ?>
        
        <?php if (isset($nice_rank_data[0])) { ?>
        <tr>
            <td><h4>NiceRank</h4></td>
            <td></td>
        </tr>        
        <tr>
        	<td>Rank:</td>
        	<td><?php echo $nice_rank_data[0]->rank; ?></td>
        </tr>
        <tr>
        	<td>Real Person:</td>
        	<td>
        		<?php 
        			$real_person = $nice_rank_data[0]->account->real_person; 
	        		
	        		if ($real_person = '1') {
		        		echo "Yes";
	        		} else {
		        		echo "No";
	        		}
        		?>
        	</td>
        </tr>
        <tr>
        	<td><h5>Past 28 days:</h5></td>
			<td></td>
        </tr>
        <tr>
        	<td>Robot_Posts:</td>
        	<td><?php echo $nice_rank_data[0]->stats->robo_posts; ?></td>
        </tr>
        <tr>
        	<td>Posts:</td>
        	<td><?php echo $nice_rank_data[0]->stats->post_count; ?></td>
        </tr>
        <tr>
        	<td>Conversations:</td>
        	<td><?php echo $nice_rank_data[0]->stats->conversations; ?></td>
        </tr>
        <tr>
        	<td>Links:</td>
        	<td><?php echo $nice_rank_data[0]->stats->links; ?></td>
        </tr>
        <tr>
        	<td>Mentions:</td>
        	<td><?php echo $nice_rank_data[0]->stats->mentions; ?></td>
        </tr>
        <tr>
        	<td>Questions:</td>
        	<td><?php echo $nice_rank_data[0]->stats->questions; ?></td>
        </tr>
        <?php } ?>
        
        <!--
<?php if ($username != $auth_username) { ?>     
        <tr>
            <td><h4>Spam User Check</h4></td>
            <td></td>
        </tr>        
        <tr>
            <td>Spam User:</td>
            <td><?php 
                    $posts_per_day = round(($data['counts']['posts'] / $interval->days), 2);
                    if ($posts_per_day < 200) {
                        echo "No";
                ?>
            </td>
        </tr>    
                <?php
                    } else {
                        echo "Yes";
                ?>
            </td>
        </tr>
        <tr>
            <td>Correctly Marked:</td>
            <td>
                <?php
                    if ($posts_per_day > 200) {
                        if ($data['type'] = "human") {
                            echo "No (marked as a human)";
                        } else {
                            if ($data['type'] = "feed") {
                                echo "Yes (marked as a feed)";
                            }
                            if ($data['type'] = "bot") {
                                echo "Yes (marked as a bot)";
                            }
                        }
                    }
                ?>
            </td>
        </tr>
        <?php } ?>
        <?php } ?>
-->
        
        <?php if ($clubs->memberclubs == true) { ?>
        <tr>
            <td><h4>User PCA Clubs</h4></td>
            <td></td>
        </tr>
        <tr>
            <td>Most Recent:</td>
            <td>
                <?php
                    $recent_club_number = count($user_clubs) -1;
                    echo $user_clubs[$recent_club_number];
                ?>
            </td>
        </tr>
        <tr>
            <td>Number of Clubs:</td>
            <td>
                <?php
                    $number_of_clubs = count($user_clubs) -1;
                    echo $number_of_clubs;
                ?>
            </td>
        </tr>
        <tr>
            <td><a href='http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements' target='_blank'>More info on PCA clubs</a></td>
            <td></td>
        </tr>
        <?php } ?>
    </table>
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
