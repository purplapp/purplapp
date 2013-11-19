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
<?php if($posts->getPosts() !== false) { ?>
<b><?php echo $posts->user_id; ?></b> has <b><?php echo $posts->posts; ?></b> posts and is a member of the following clubs:<br />
<ul>
	<?php 

	foreach($posts->memberclubs as $club) {
		echo "<li>".$club."</li>";
	}

	?>
</ul>
<?php } else { echo "No user found"; } ?>