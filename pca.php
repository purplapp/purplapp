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

    //require config.php
    require('config.php');
     
    //Use the access token
    $json = file_get_contents('https://alpha-api.app.net/stream/0/users/'.$id.'?access_token='.ACCESS_TOKEN.'&include_user_annotations=1?callback=awesome?jsonp=parseResponse');
    $obj = json_decode($json); 
    $posts=$obj->data->counts->posts;
    $userID=$obj->data->username;
    $data=$obj->data
  ?>

  <!-- header.php -->
  <?php $title = "PCA Information for " . $id . ""; include "include/header.php"; ?>

  <div class="col-md-12">
    <h1>
      <?php echo $data->name; ?>
    </h1>
    <h3>
      <?php echo "<a class='url' href=".$data->canonical_url.">@".$data->username."</a>"; ?>
    </h3>

    <!--Avatar Image-->
    <img class="avatar" src="<?php echo $data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

    <!--Cover Image-->
    <img class="cover" src="<?php echo $data->cover_image->url; ?>" alt="cover" height="180" /> 

    <br><br>

    <!--Search Box-->
    <div class="row">
        <form role="form" class="form-inline">
            <div class="col-lg-3">
              <div class="input-group">
                <input type='text' class="form-control" name='id' id="id" value="<?php echo $id; ?>"/>
                <span class="input-group-btn">
                  <button type="submit" name="send" id="send" class="btn btn-primary">Check</button>
                </span>
              </div>
            </div>
        </form>
      </div>

  <!--Post Count Achievements-->
  <div class="col-md-6">
    <p class="pca">
      <br>
      <a class="pca" href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements">All PCA Clubs:</a>
      <br><br>
      <?php
        if ($c > 80211) { $posts=$c;}
        $type = $obj->data->type;

        if ($posts == 0) {
          echo "No Posts";
        }

        if ($posts < 500 AND $posts > 0) {
          echo "No Clubs! Next Club: 🍞 &nbsp;";
        }

        if ($posts > 500) {
          echo "🍞 &nbsp;";}else{ echo "";
        } 

        if ($posts > 1000) {
          echo "🍰 &nbsp;";}else{ echo "";
        } 

        if ($posts > 2000) {
          echo "🍥 &nbsp;";}else{ echo "";
        } 

        if ($posts > 2600) {
          echo "☎️ &nbsp;";}else{ echo "";
        } 

        if ($posts > 3000) {
          echo "🔎 &nbsp;";}else{ echo "";
        } 

        if ($posts > 5000) {
          echo "👟 &nbsp;";}else{ echo "";
        } 

        if ($posts > 8088) {
          echo "💻 &nbsp;";}else{ echo "";
        } 

        if ($posts > 10000) {
          echo "🍪 &nbsp;";}else{ echo "";
        }

        if ($posts > 11000) {
          echo "💉 &nbsp;";}else{ echo "";
        }  

        if ($posts > 20000) {
          echo "🍳 &nbsp;";}else{ echo "";
        } 

        if ($posts > 24000) {
          echo "💎 &nbsp;";}else{ echo "";
        } 

        if ($posts > 25000) {
          echo "🍛 &nbsp;";}else{ echo "";
        } 

        if ($posts > 30000) {
          echo "✈️ &nbsp;";}else{ echo "";
        } 

        if ($posts > 31416) {
          echo "⭕ &nbsp;";}else{ echo "";
        } 

        if ($posts > 42000) {
          echo "🐳 &nbsp;";}else{ echo "";
        } 

        if ($posts > 47000) {
          echo "🔪 &nbsp;";}else{ echo "";
        }

        if ($posts > 50000) {
          echo "🐷 &nbsp;";}else{ echo "";
        } 

        if ($posts > 57000) {
          echo "🚀 &nbsp;";}else{ echo "";
        } 

        if ($posts > 64000) {
          echo "🔱 &nbsp;";}else{ echo "";
        } 

        if ($posts > 68000) {
          echo "Ⓜ️ &nbsp;";}else{echo "";
        }

        if ($posts > 76000) {
          echo "🎶 &nbsp;";}else{ echo "";
        } 

        if ($posts > 80211) {
          echo "📶 &nbsp;";}else{ echo "";
        } 

        if ($posts > 90000) {
          echo "💷 &nbsp;";}else{ echo "";
        }

        if ($posts > 100000) {
          echo "🗼 &nbsp;";}else{ echo "";
        }

        if ($posts > 500) {
          echo "<hr>";
        }
        
        echo "</a>";
      ?>
    </p>

    <p class="pca">
      The Main PCA Clubs: 
      <br><br>
      <?php
        if ($c > 80211) { $posts=$c;}
        $type = $obj->data->type;

        if ($posts == 0) {
          echo "No Posts";
        }

        if ($posts > 10000) {
          echo "🍪 &nbsp;";}else{ echo "";
        }

        if ($posts > 11000) {
          echo "💉 &nbsp;";}else{ echo "";
        }  

        if ($posts > 20000) {
          echo "🍳 &nbsp;";}else{ echo "";
        } 

        if ($posts > 24000) {
          echo "💎 &nbsp;";}else{ echo "";
        } 

        if ($posts > 25000) {
          echo "🍛 &nbsp;";}else{ echo "";
        } 

        if ($posts > 30000) {
          echo "✈️ &nbsp;";}else{ echo "";
        } 

        if ($posts > 31416) {
          echo "⭕ &nbsp;";}else{ echo "";
        } 

        if ($posts > 42000) {
          echo "🐳 &nbsp;";}else{ echo "";
        } 

      if ($posts > 47000) {
            echo "🔪 &nbsp;";}else{ echo "";
        }

        if ($posts > 50000) {
          echo "🐷 &nbsp;";}else{ echo "";
        } 

        if ($posts > 57000) {
          echo "🚀 &nbsp;";}else{ echo "";
        } 

        if ($posts > 64000) {
          echo "🔱 &nbsp;";}else{ echo "";
        } 

        if ($posts > 68000) {
            echo "Ⓜ️ &nbsp;";}else{echo "";
        }

        if ($posts > 76000) {
          echo "🎶 &nbsp;";}else{ echo "";
        } 

        if ($posts > 80211) {
          echo "📶 &nbsp;";}else{ echo "";
        } 

        if ($posts > 90000) {
          echo "💷 &nbsp;";}else{ echo "";
        }

        if ($posts > 100000) {
          echo "🗼 &nbsp;";}else{ echo "";
        }
        echo "</a>";
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
    echo "<img src=\"$url\" alt=\"\"/>";} 
      
  function linker($at,$id) {
    echo "<a href=\"./posts?id=".$id."&".$at."\">";}
?>