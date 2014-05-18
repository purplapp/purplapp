<?php
    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);  
$base_path="..";
    require_once $base_path.'/ADN_php/EZAppDotNet.php';
    require($base_path.'/ADN_php/newFunctions.php');

    $app = new EZAppDotNet();

    $user_params = array(
        'include_user_annotations' => true, 
    );

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
        include($base_path.'/include/header_auth.php');

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

        $clubs = new PostClubs;

        $clubs->setUserPost($data['counts']['posts']);
        $clubs->getClubs();

        $user_clubs = $clubs->memberclubs
?>

<div class="col-md-12">
    <!-- User Name -->
    <div class="page-header">
        <h4>User Lookup</h4>
        <h1>
          <?php echo $data['name'] ?>
          <small>
            <?php echo "<a class='url' href='http://alpha.jvimedia.org/".$data['username']."'>@".$data['username']."</a>" ?>
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
    <table class="table">
        <tr>
            <td><h4>ADN Data</h4></td>
            <td></td>
        </tr>
        <tr>
            <td>Posts:</td>
            <td><?php echo $data['counts']['posts']; ?></td>
        </tr>
        <tr>
            <td>Starred:</td>
            <td><?php echo $data['counts']['stars']; ?></td>
        </tr>
        <tr>
            <td>Following:</td>
            <td><?php echo $data['counts']['following']; ?></td>
        </tr>
        <tr>
            <td>Followers:</td>
            <td><?php echo $data['counts']['followers']; ?></td>
        </tr>
        <tr>
            <td>Account Type:</td>
            <td><?php echo ucfirst($data['type']); ?></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td><?php echo $data['timezone']; ?></td>
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
                    //$dateresult = $date->format('Y-m-d H:i:s');
                    $dateresult = $date->format('H:i \o\n d M Y');
                    
echo $dateresult;
                ?>
            </td>
        </tr> 
        <tr>
            <td>ADN Age:</td>
            <td>
                <?php 
                    //calculate current date for day calc
                    $today = date('Y-m-d');

                    //calculate date created for day calc
                    $createdat= new DateTime($data['created_at']);
                    $adnjoin = $createdat->format('Y-m-d');

                    //calculate number of days on ADN
                    $date1 = new DateTime($adnjoin);
                    $date2 = new DateTime($today);
                    $interval = $date1->diff($date2);
                    
                    echo $interval->days, " days";
                ?>
            </td>
        </tr>
        <tr>
            <td>Locale:</td>
            <td><?php echo $data['locale']; ?></td>
        </tr>
        <?php 
            if(isset($data['verified_link'])) {
                $verified_link = "y";
            } else {
                $verified_link = "n";
            }
        if (($verified_link = "y") and $data['annotations']) { ?>
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
                echo "<a class='url' href='".$verified_link."'>".$data['verified_domain']."</a>";
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
                    echo "<a href=".$blogurl.">".parse_url($blogurl, PHP_URL_HOST)."</a>";
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
                    echo "<td>Facebook ID:</td>";
                    echo "<td>";
                    echo '<a href="http://facebook.com/'.$facebook_id.'">'.$facebook_id.'</a>';
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
                    echo "<td>Twitter ID:</td>";
                    echo "<td>";
                    echo '<a href="http://twitter.com/'.$twitter_id.'">@'.$twitter_id.'</a>';
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
    <table class="table">
        <?php if ($username != $auth_username) { ?>
        <tr>
            <td><h4>Comparison</h4></td>
            <td></td>
        </tr>
        <tr>
            <td class="">Follows You:</td>
            <td><?php if ($data['follows_you']){ echo "Yes"; } else { echo "No"; } ?></td>            
        </tr>
        <tr>
            <td class="">You Follow:</td>
            <td><?php if ($data['you_follow']){ echo "Yes"; } else { echo "No"; } ?></td>            
        </tr>
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
                    $firstpost_created_at = $created_at->format('Y-m-d H:i:s');

                    $firstpostlink = $firstpost[0]['canonical_url'];
                ?>
                <a href="<?php echo $firstpostlink; ?>"><?php echo $firstpost_created_at; ?></a>
            </td>
        </tr>

        <?php
            $mention_params = array(
              'count' => '-1',
            );

            $firstmention = $app->getUserMentions($user_id="$user_number", $mention_params);

            if ($firstmention) {
                $created_at = new DateTime($firstmention[0]['created_at']);
                $firstmention_created_at = $created_at->format('Y-m-d H:i:s');

                $firstmentionlink = $firstmention[0]['canonical_url'];

                $firstmention_user = $firstmention[0]['user']['username'];
                $firstmention_user_link = $firstmention[0]['user']['canonical_url'];
        ?>
        <tr>
            <td class="">First Mention:</td>
            <td>
                <a href="<?php echo $firstmentionlink; ?>"><?php echo $firstmention_created_at; ?></a> by <a href="http://alpha.jvimedia.org/<?php echo $firstmention_user; ?>">@<?php echo $firstmention_user; ?></a>
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
                ?>
                <a href="<?php echo $lastpostlink; ?>"><?php echo $lastpost_created_at; ?></a>
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
        ?>
        <tr>
            <td class="">Last Mention:</td>
            <td>
                <a href="<?php echo $lastmentionlink; ?>"><?php echo $lastmention_created_at; ?></a> by <a href="http://alpha.jvimedia.org/<?php echo $lastmention_user; ?>">@<?php echo $lastmention_user; ?></a>
            </td>
        </tr>               
        <?php } ?>

        <tr>
            <td>Average Daily Posts:</td>
            <td><?php echo round(($data['counts']['posts'] / $interval->days), 2); ?></td>    
        </tr>
        <tr>
            <td>Average Daily Stars</td>
            <td><?php echo round(($data['counts']['stars'] / $interval->days), 2); ?></td>    
        </tr>            
        <?php } ?>
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
            <td><a href='http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements'>More info on PCA clubs</a></td>
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
