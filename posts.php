<!DOCTYPE html>
<html>

<head>
<?php
$c=$_GET[cd];
$c++;
$id=$_GET["id"];
if(!$id){ $id="@charl";}elseif($id=="Infinite Stratos"){ 
echo "Ohai!<br>";
$id="@charl";
 }
 if ($c > 1000){echo "$c Cheater";}

 if ($id[0]!="@"){ $id="@".$id;}

?>


<title>User Information for <? echo $id; ?></title>
<meta name="description" content="A test.">
<meta name="keywords" content="Test,PHP">
<meta name="author" content="Charl and Johannes">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


<?php

//require config.php
require('config.php');
 
//Use the access token
$json = file_get_contents('https://alpha-api.app.net/stream/0/users/'.$id.'?access_token='.ACCESS_TOKEN.'&include_user_annotations=1?callback=awesome?jsonp=parseResponse');
$obj = json_decode($json); 
$posts=$obj->data->counts->posts;
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

<!--Profile URL-->
<p class="url">&nbsp;</p>
<p class="url"><a class="url" href="<?php echo $obj->data->canonical_url; ?>">Profile URL</a>
  
  &nbsp;-&nbsp;
  
  <!--Authorised URL-->
  
  <?php
$verfied_domain = $obj->data->verified_domain;

if (!$verfied_domain) { echo "No Verified Domain";} else 
{ 
	echo "<a class=\"url\" href=\"http://".$verfied_domain."\">Verified Domain: \"".$verfied_domain."\"</a>";
}
	

?>
</p>

<!--Funny Stuff-->
<p class="charljvim"
<span id="myData">
<?php
if ($id=="@jvimedia"){echo "<br> Mail? Yep! E-Mail me!!!! => adn@a.jvimedia.org <= DO IT! <br><br>";} elseif($id=="@charl"){echo "<br>"; linker("me=1&o=$id&cd=$c","@jvimedia"); echo "
I built this page! </a><br><br>";}
$o=$_GET["o"];
if ($_GET["me"]==1)
{ echo "<h1>"; linker("me=1&o=$id&cd=$c",$o); echo " $o ; I built this page!! ... <br> $id ; ME TOO!!!!!</h1></a>";}
?>
</span>
</p>

<!--User Bio-->
<p class="bio">
<span id="myData">


<?php     


echo $obj->data->description->html;
?>
</span>
</p>

<hr>

<!--Info-->
<p class="counts">
Posts:
<span id="myData">

<?php     
echo $obj->data->counts->posts;
?>
</span>

<br>

Starred:
<span id="myData">

<?php     
echo $obj->data->counts->stars;
?>
</span>

<br>

Following:
<span id="myData">

<?php     
echo $obj->data->counts->following;
?>
</span>

<br>

Followers:
<span id="myData">

<?php     
echo $obj->data->counts->followers;
?>
</span>

<br>

<?php     

if ($id=="@jvimedia"){echo '
E-Mail Inbox:
<span id="myData">';

echo ($obj->data->counts->followers)+($obj->data->counts->following)+($obj->data->counts->posts);

echo "</span>";
}elseif($id=="@charl"){ echo "IS Shield Health: "; echo percentage($obj->data->counts->followers,$obj->data->counts->following)/$c; echo "%";}
?>
<br>

<span id="myData">
<?php if ($id=="@charl"){ echo "IS Type: "; }else { echo "Account Type: ";} ?>
<?php
if ($id=="@jvimedia"){echo "Sometimes ... a ";echo $obj->data->type;}elseif($id=="@charl"){echo "Raphael Revive Custom II";}else{
	echo $obj->data->type;}
?>
</span>

<br>

<span id="myData">
<?php if ($id=="@charl"){ echo "IS Location: "; }else { echo "User Location: ";} ?>
<?php
if ($id=="@jvimedia"){echo "IS Control Room - GERMANY";}elseif($id=="@charl"){echo "IS Academy";}else{
	echo $obj->data->timezone;}

?>
</span>

<br>

<?php if ($id=="@charl"){ echo "IS Model Number:"; }else { echo "User Number:";} ?>
<span id="myData">

<?php     
echo $obj->data->id;
?>
</span>
</p>

<hr>

<!--Post Count Achievements-->

<p class="pca">
<a class="pca" href="http://appdotnetwiki.net/w/index.php?title=Post_Count_Achievements"><?php
if ($c > 80211) { $posts=$c;}
$type = $obj->data->type;
if ($type == "feed"|| $type == "bot"){echo "This is a $type account ... so its not in any club but it would be in the following clubs: <br>"; }else { echo "Currently in: ";}

if ($posts == 0) {
	echo "No Posts?!";
}
if ($posts < 500) {
echo "Oh! - No Clubs! Next step: 🍞 &nbsp;";}

if ($posts > 500) {
echo "🍞 &nbsp;";}

if ($posts > 1000) {
echo "🍰 &nbsp;";}

if ($posts > 2000) {
echo "🍥 &nbsp;";}

if ($posts > 2600) {
echo "☎️ &nbsp;";}

if ($posts > 3000) {
echo "🔎 &nbsp;";}

if ($posts > 5000) {
echo "👟 &nbsp;";}

if ($posts > 8088) {
echo "💻 &nbsp;";}

if ($posts > 10000) {
echo "🍪 &nbsp;";}

if ($posts > 11000) {
echo "💉 &nbsp;";} 

if ($posts > 20000) {
echo "🍳 &nbsp;";}

if ($posts > 24000) {
echo "💎 &nbsp;";}

if ($posts > 25000) {
echo "🍛 &nbsp;";}

if ($posts > 30000) {
echo "✈️ &nbsp;";}

if ($posts > 31416) {
echo "⭕ &nbsp;";}

if ($posts > 42000) {
echo "🐳 &nbsp;";}

if ($posts > 50000) {
echo "🐷 &nbsp;";}

if ($posts > 64000) {
echo "🔱 &nbsp;";}

if ($posts > 68000) {
	echo "Ⓜ️ &nbsp;";}

if ($posts > 76000) {
echo "🎶 &nbsp;";}

if ($posts > 80211) {
echo "📶 &nbsp;";}

if ($posts > 100000) {
echo "🗼 &nbsp;";}

if ($posts > 500) {
	echo "<hr>";
}
echo "</a>";

?>
</a>

<p class="credits">
Built by <a href="https://app.net/charl">@charl<a/> with assistance from <a href="https://app.net/jvimedia">@jvimedia</a>.
<br>
Hosted by <a href="http://jvimedia.org">jvimedia.org</a>.
<br>
November 2013
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