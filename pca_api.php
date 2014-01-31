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


PCA Information for <? echo $id; ?>

<?php

//require config.php
require('config.php');
 
//Use the access token
$json = file_get_contents('https://alpha-api.app.net/stream/0/users/'.$id.'?access_token='.ACCESS_TOKEN.'&include_user_annotations=1?callback=awesome?jsonp=parseResponse');
$obj = json_decode($json); 
$posts=$obj->data->counts->posts;
$userID=$obj->data->username;


        echo $obj->data->name;

  <!--Post Count Achievements-->
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
