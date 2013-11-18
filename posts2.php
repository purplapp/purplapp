<?php
//Required files
require('config.php');
require('posts.class.php');

if(!empty($_GET['u'])) {
	$userID = $_GET['u'];
} else {
	$userID = "@charl";
}

$posts = new Posts;

$posts->setUserID($userID);
$posts->getPosts();
$posts->getClubs();

?>
<form method='GET' action=''>
	<input type='text' name='u' />
	<input type='submit' />
</form>
<b><?php echo $posts->user_id; ?></b> is a member of the following clubs:<br />
<ul>
	<?php 

	foreach($posts->memberclubs as $club) {
		echo "<li>".$club."</li>";
	}

	?>
</ul>