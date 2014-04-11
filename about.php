<?php 
    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);   

	$title = "About Purplapp"; 
	include('include/header.php'); 
	include('config.php');
	$obj = json_decode(file_get_contents('https://api.app.net/users?ids=@charl,@hu,@jvimedia&access_token='.ACCESS_TOKEN.''));
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>About Purplapp <small> &copy; 2013-<?php echo date("Y") ?></small></h1>
	</div>

	<i>Hopefully this might clear up any questions you have.</i>

	<h2>The Idea</h2>
	<p>
		Purplapp was first conceived by Charlotte (@charl) in September 2013. You can see the posts on App.net about the idea <a href="https://alpha.app.net/charl/post/11384578">here</a>.
		<br><br>
		From that, an iOS app concept was produced and uploaded as Charlotte's debut on Dribbble. You can find this concept <a href="http://dribbble.com/shots/1253484-Post-Count-Achievements">here</a>. We've not actually developed the iOS app concept into reality, but that's a future goal... when we find an iOS developer.
		<br><br>
		Charlotte kidnapped Johannes (@jvimedia) and made him host the site.
		<br><br>
		We wrote the web app in October 2013. It wasn't exactly the best thing in the world, but it works. You can actually see the original app on this site <a href="orig/posts.php">but as you can see, it looks horrible.</a>
		<br><br>
		After that, Charlotte and Johannes (who got roped in somehow...) found Hugo (@hu) in November. He wrote the Post Count Achievement thing to be useful! It was pretty good before (it wasn't), but afterwards it was even better! ;)
		<br><br>
		We "bootstrapped" it in February 2014. After that, we retired the old site, and switched all our work to the new site. We don't update the old one any more. :(
		<br><br>
		Future ideas and suggestions can be emailed to <a href="mailto:purplapp@hry.jvimedia.co.uk?Subject=I%20have%20an%20idea%20for%20Purplapp%20" target="_top">this address</a>. Alternatively, you could file an issue on our <a href="http://github.com/purplapp/purplapp">GitHub repository</a>.
	</p>

	<h2>The Team</h2>
	<p>
		Purplapp is developed and maintained by a core team of three.
	</p>	
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<img src="<?php echo $obj->data[0]->avatar_image->url;?>" alt="avatar1" width="180" height="180">
				<div class="caption">
					<h3><?php echo $obj->data[0]->name;?></h3>
					<p>Charlotte is the lead developer. She attempts to write most of the code.</p>
					<p><a href="<?php echo $obj->data[0]->canonical_url;?>" class="btn btn-primary" role="button">App.net</a> <a href="http://github.com/charlw" class="btn btn-success" role="button">GitHub</a> <a href="<?php echo $obj->data[0]->verified_link;?>" class="btn btn-info" role="button">Site</a></p>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<img src="<?php echo $obj->data[1]->avatar_image->url;?>" alt="avatar2" width="180" height="180">
				<div class="caption">
					<h3><?php echo $obj->data[1]->name;?></h3>
					<p>Johannes does the hosting, and makes sure Charlotte doesn't do anything stupid.</p>
					<p><a href="<?php echo $obj->data[1]->canonical_url;?>" class="btn btn-primary" role="button">App.net</a> <a href="http://github.com/jvimedia" class="btn btn-success" role="button">GitHub</a> <a href="<?php echo $obj->data[1]->verified_link;?>" class="btn btn-info" role="button">Site</a></p>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail">
				<img src="<?php echo $obj->data[2]->avatar_image->url;?>" alt="avatar3" width="180" height="180">
				<div class="caption">
					<h3><?php echo $obj->data[2]->name;?></h3>
					<p>Hugo customised the Bootstrap, and writes a lot of the backend stuff.</p>
					<p><a href="<?php echo $obj->data[2]->canonical_url;?>" class="btn btn-primary" role="button">App.net</a> <a href="http://github.com/jvimedia" class="btn btn-success" role="button">GitHub</a> <a href="<?php echo $obj->data[2]->verified_link;?>" class="btn btn-info" role="button">Site</a></p>
				</div>
			</div>
		</div>
	</div>

	<h2>Credits</h2>
    <ul class='list-unstyled'>
    	<li>Font Awesome by Dave Gandy - <a href="http://fontawesome.io">fontawesome.io</a></li>
		<li>PCA Icons by Yusuke Kamiyamane - <a href="http://p.yusukekamiyamane.com">p.yusukekamiyamane.com</a></li>
		<li>Glyphicon Halflings by Glyphicons - <a href="http://glyphicons.com">glyphicons.com</a></li>
	</ul>
	 
	<h2>Other Stuff</h2>
	<ul class='list-unstyled'>
		<li>We like crediting people, so feel free to look at our <a href="humans.txt">humans.txt</a>.</li>
	    <li>We have to display an imprint, so here is our <a href="images/imprint.png">imprint</a>.</li>
	</ul>
</div>
<?php include('include/footer.php'); ?>