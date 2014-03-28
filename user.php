<?php
    //Required files
    require('config.php');
    require('posts.class.php');

    if(!empty($_GET['id'])) {
      $userID = $_GET['id'];
    } else {
      $userID = "@charl";
    }

    //Check to see if the @ is included, if not, add it!
    if(substr($userID, 0, 1) !== "@") {
      $userID = "@" . $userID;
    }

    //Set Default Timezone
    date_default_timezone_set('utc');

    //Pulling From posts.class.php and Interpreting
    $posts = new Posts;

    $posts->setUserID($userID);
    $posts->getPosts();
    $posts->getClubs();
    $posts->getData();
    $posts->getUserPosts();
    $posts->getUserBroadcasts();
    $posts->getUserPatter();

    $data = $posts->user_data;
    $userposts = $posts->user_posts;
    $anno = $data->annotations;
    $userbroadcasts = $posts->user_broadcasts;
    $userpatter = $posts->user_patter;


    //Declaring UserType
    $usertype = ucfirst($data->type);

    //calculating date created for output
    $date = new DateTime($data->created_at);
    $dateresult = $date->format('Y-m-d H:i:s');

    //calculate current date for day calc
    $today = date('Y-m-d');
    
    //calculate date created for day calc
    $createdat= new DateTime($data->created_at);
    $adnjoin = $createdat->format('Y-m-d');

    //calculate number of days on ADN
    $date1 = new DateTime($adnjoin);
    $date2 = new DateTime($today);
    $interval = $date1->diff($date2);

    //calculate posts per day
    $ppd = $data->counts->posts / $interval->days;

    //calculate date of last post
    foreach($userposts as $userpostsC){
      $created_at = new DateTime($userpostsC->created_at);
      $lastpost = $created_at->format('Y-m-d H:i:s');

      $lastpostlink = $userpostsC->canonical_url;
    }

    //Header
    $title = "User Information for @" . $data->username . "";
    include('include/header.php');
  ?>


  <?php if($posts->getData() !== false) { ?>
  <?php if($data->counts->posts !== 0) { ?>
    <div class="col-md-12">
<!-- 	  <?php 
        print "<pre>"; 
        print_r($userpatter); 
        print "</pre>"; 
      ?>
 -->     
	  <div class="alert alert-warning alert-dismissable">
	    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Information -</strong> we are aware of the page load times being high. We are investigating the issue.
	  </div> 
      <h1>
        <?php echo $data->name ?>
      </h1>

      <h3>
        <?php echo "<a class='url' href=".$data->canonical_url.">@".$data->username."</a>" ?>
      </h3>

      <!--Avatar Image-->
      <img class="avatar" src="<?php echo $data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

      <!--Cover Image-->
      <div class="cover">
        <img src="<?php echo $data->cover_image->url; ?>" alt="cover" height="180"/> 
      </div>

      <br><br>

      <!--Search Box-->
      <div class="row">
        <form role="form" class="form-inline">
            <div class="col-lg-3">
              <div class="input-group">
                <input type="text" class="form-control" name="id" id="id" value="<?php echo $userID; ?>"/>
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
        <?php echo $data->description->html; ?>
      </p>
    </div>

    <div class="col-md-6">
      <!--Info-->
      <table class="table">
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
        <tr>
          <td>Joined:</td>
          <td><?php echo $dateresult; ?></td>
        </tr> 
        <tr>
          <td>ADN Age:</td>
          <td><?php echo $interval->days; ?></td>
        <tr>
          <td>Locale:</td>
          <td><?php echo $data->locale; ?></td>
        </tr>
        <tr>
          <td>Posts Per Day:</td>
          <td><?php echo round($ppd, 2); ?></td>    
        </tr>
        <tr>
          <td>Last Post:</td>
          <td><a href="<?php echo $lastpostlink; ?>"><?php echo $lastpost; ?></a></td>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"core.directory.blog") != false){
                $blogurl=$annoC->value->url;
                echo "<td>Blog:</td>";
                echo "<td>";
                echo "<a href=\"$blogurl\">$blogurl</a>";
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"core.directory.facebook") != false){
                $faceurl=$annoC->value->id;
                echo "<td>Facebook ID:</td>";
                echo "<td>";
                echo "<a href=\"http://facebook.com/$faceurl\">$faceurl</a>";
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"core.directory.twitter") != false){
                $twiturl=$annoC->value->username;
                echo "<td>Twitter Handle:</td>";
                echo "<td>";
                echo "<a href=\"http://twitter.com/$twiturl\">@$twiturl</a>";
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"appnetizens.userinput.birthday") != false){
                $bday=$annoC->value->birthday;
                echo "<td>Birthday:</td>";
                echo "<td>";
                echo $bday;
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
          foreach($anno as $annoC){
              $type = $annoC->type;
              if (strpos($type,"appnetizens.userinput.gender") != false){
                $mf=$annoC->value->gender;
                echo "<td>Gender:</td>";
                echo "<td>";
                echo ucwords($mf);
                echo "</td>"; }}
          ?>
        </tr>
        <tr>
          <?php
            if($data->verified_domain) {
              echo "<td>Verified Domain:</td>";
              echo "<td>";
              echo "<a class='url' href='http://".$data->verified_domain."'>http://".$data->verified_domain."</a>";
              echo "</td>";
            }
          ?>
        </tr>
      </table>
    </div>

    <div class="col-md-6">
      <?php
        if ($posts->memberclubs != false) {
          echo "<h3 style='margin-top: -3px;''><a href='http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements'>Post Count Achievements</a></h3>";
          echo "<div class='pca'>";
          echo "<ul class='list-unstyled'>";
          foreach($posts->memberclubs as $club){
            echo "<li>".$club."</li>";
          }
          echo "</ul>";
          echo "</div>";
      }
      ?>

      <?php
      	if ($userbroadcasts != false) {
          echo "<h3>Broadcast Channels</h3>";
          echo "<div class='pca'>";
          echo "<ul class='list-unstyled'>";
          echo "<li>";
          foreach($userbroadcasts[0]->annotations as $userbroadcastsC){
              $type = $userbroadcastsC->type;     
              if (strpos($type,"core.fallback_url") != false){
                $fallback_url=$userbroadcastsC->value->url;
                echo "<a class='url' href='".$fallback_url."'>".$userbroadcasts[0]->annotations[0]->value->title."</a> ";
              }
          }
          foreach($userbroadcasts[0]->annotations as $userbroadcastsC){
              $type = $userbroadcastsC->type;
              if (strpos($type,"core.broadcast.freq") != false){
              	$avg_freq = $userbroadcastsC->value->avg_freq;
              	echo "(".$avg_freq.")";
              }
          }
          echo "</li>";
          echo "<li>";
          if ($userbroadcasts[1] != false) {
	          foreach($userbroadcasts[1]->annotations as $userbroadcastsC){
	              $type = $userbroadcastsC->type;     
	              if (strpos($type,"core.fallback_url") != false){
	                $fallback_url=$userbroadcastsC->value->url;
	                echo "<a class='url' href='".$fallback_url."'>".$userbroadcasts[1]->annotations[0]->value->title."</a> ";
	              }
	          }
	          foreach($userbroadcasts[1]->annotations as $userbroadcastsC){
	              $type = $userbroadcastsC->type;
	              if (strpos($type,"core.broadcast.freq") != false){
	              	$avg_freq = $userbroadcastsC->value->avg_freq;
	              	echo "(".$avg_freq.")";
	              }
	          }
	      }
          echo "</li>";
          echo "<li>";
          if ($userbroadcasts[2] != false) {
	          foreach($userbroadcasts[2]->annotations as $userbroadcastsC){
	              $type = $userbroadcastsC->type;     
	              if (strpos($type,"core.fallback_url") != false){
	                $fallback_url=$userbroadcastsC->value->url;
	                echo "<a class='url' href='".$fallback_url."'>".$userbroadcasts[2]->annotations[0]->value->title."</a> ";
	              }
	          }
	          foreach($userbroadcasts[2]->annotations as $userbroadcastsC){
	              $type = $userbroadcastsC->type;
	              if (strpos($type,"core.broadcast.freq") != false){
	              	$avg_freq = $userbroadcastsC->value->avg_freq;
	              	echo "(".$avg_freq.")";
	              }
	          }
	      }
          echo "</li>";
          echo "<li>";
          if ($userbroadcasts[3] != false) {        
	          foreach($userbroadcasts[3]->annotations as $userbroadcastsC){
	              $type = $userbroadcastsC->type;     
	              if (strpos($type,"core.fallback_url") != false){
	                $fallback_url=$userbroadcastsC->value->url;
	                echo "<a class='url' href='".$fallback_url."'>".$userbroadcasts[3]->annotations[0]->value->title."</a> ";
	              }
	          }
	          foreach($userbroadcasts[3]->annotations as $userbroadcastsC){
	              $type = $userbroadcastsC->type;
	              if (strpos($type,"core.broadcast.freq") != false){
	              	$avg_freq = $userbroadcastsC->value->avg_freq;
	              	echo "(".$avg_freq.")";
	              }
	          }
	      }
          echo "</li>";
          echo "</ul>";
          echo "</div>";  
        }          
      ?>

      <?php
        if ($userpatter != false) {
          echo "<h3>Patter Rooms</h3>";
          echo "<div class='pca'>";
          echo "<ul class='list-unstyled'>";
          echo "<li><a href='".$userpatter[0]->annotations[1]->value->url."'>".$userpatter[0]->annotations[0]->value->name."</a></li>";
          echo "<li><a href='".$userpatter[1]->annotations[1]->value->url."'>".$userpatter[1]->annotations[0]->value->name."</a></li>";
          echo "<li><a href='".$userpatter[2]->annotations[1]->value->url."'>".$userpatter[2]->annotations[0]->value->name."</a></li>";
          echo "<li><a href='".$userpatter[3]->annotations[1]->value->url."'>".$userpatter[3]->annotations[0]->value->name."</a></li>";
          echo "</ul>";
          echo "</div>";
        }
      ?>      
    </div>
    
  <?php } else { echo "This user doesn't have any posts!"; } ?>
  <?php } else { echo "Data not loaded: this account doesn't exist or isn't marked as a human."; } ?>

  <!-- footer.php -->
  <?php include "include/posts_footer.php"; ?>