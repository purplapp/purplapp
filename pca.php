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


<title>PCA Information for <? echo $id; ?></title>
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

?>

<style>
  h1 { font-family: Arial, sans-serif;}
  p.url { font-family: Arial, sans-serif;}
  p.authurl { font-family: Arial, sans-serif;}
  p.charljvim { font-family: Arial, sans-serif;}
  p.bio { font-family: Arial; font-style: italic; sans-serif;}
  p.bioheader { font-family: Arial, sans-serif;}
  p.counts { font-family: Arial, sans-serif;}
  p.pca { font-family: Arial, sans-serif;}
  p.credits {font-family: Arial; font-style: italic; color:#808080; font-size:10px; sans-serif}

  a:link {text-decoration:none;}
  a:visited {text-decoration:none;}
  a:hover {text-decoration:none;}
  a:active {text-decoration:none;}

  div.sub, iframe {
      width: 280px;
      height: 30px;
      margin: 0 auto;
      background-color: #FFFFFF;
  }

  body {
    text-align: center; /* for ie6- */
  }

  div#container {
    text-align: left; /* fix alignment for ie */
    margin: 0 auto;
    width: 700px; /* if you want the width to be fixed, set to whatever you want */
  }
</style>

</head>

<body>
<div id="divMain"> 

  <h1>
    <span id="myData">
      <?php
        echo $obj->data->name;
      ?>
    </span>
  </h1>

  <!--Avatar Image-->
  <img class="avatar" src="<?php echo $obj->data->avatar_image->url; ?>" alt="avatar" width="180" height="180"/> 

  <!--Cover Image-->
  <img class="cover" src="<?php echo $obj->data->cover_image->url; ?>" alt="cover" height="180" /> 

  <!--Follow Icon-->
  <div id="follow"> 
      <div class="sub"></div>
      <iframe src="http://adnbtns.com/adn-btn.html?user=<?php echo $obj->data->username; ?>&size=large&align=center"  allowtransparency="true" frameborder="0" scrolling="0" width="280" height="30" ></iframe>
      <br>
  </div>

  <!--Search Box-->
  <form name="form1" method="GET" action="">
    <p>
      <input name="id" type="text" id="id" value="<?php echo $id ?>">
      <input type="submit" name="send" id="send" value="Check">
    </p>
  </form>

  <!--Post Count Achievements-->

  <p class="pca">
    <a class="pca" href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements">PCA Clubs:</a>

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

      if ($posts > 50000) {
        echo "🐷 &nbsp;";}else{ echo "";
      } 

      if ($posts > 57000) {
        echo "🚀 &nbsp;";}else{ echo "";
      } 

      if ($posts > 64000) {
        echo "🔱 &nbsp;";}else{ echo "";
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

    if ($posts > 50000) {
      echo "🐷 &nbsp;";}else{ echo "";
    } 

    if ($posts > 57000) {
      echo "🚀 &nbsp;";}else{ echo "";
    } 

    if ($posts > 64000) {
      echo "🔱 &nbsp;";}else{ echo "";
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

  <p class="credits">
    Built by <a href="https://app.net/charl">@charl<a/>.
    <br>
    Hosted by <a href="http://jvimedia.org">jvimedia.org</a>.
    <br>
    If you want to see more info, check out <a href="/posts.php?u=<?php echo $userID?>">posts.php</a> instead.
  </p>

</div> 
</body>
</html>

<?php 

function percentage($val1, $val2, $precision) 
{
	$division = $val1 / $val2;

	$res = $division * 100;

	$res = round($res, $precision);
	
	return $res;
}

function echo_img($url) {
    echo "<img src=\"$url\" alt=\"
\"/>";  
    } 
    
function linker($at,$id) {
	
	echo "<a href=\"./posts?id=".$id."&".$at."\">";
}
?>
