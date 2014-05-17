<?php 
    // error_reporting(E_ALL);
    // ini_set("display_errors", 1);   

	$title = "About Purplapp"; 

	require_once './ADN_php/EZAppDotNet.php';
	$app = new EZAppDotNet();

	if ($app->getSession()) {
		include('include/header_auth.php');
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>About Purplapp <small> &copy; 2013-<?php echo date("Y") ?></small></h1>
	</div>
</div>

<div class="col-md-6">
	<h2>The Idea</h2>
	<p>
		Purplapp was first conceived by Charlotte (@charl) in September 2013. You can see the posts on App.net about the idea <a href="https://alpha.app.net/charl/post/11384578">here</a>.
		<br><br>
		From that, an iOS app concept was produced and uploaded as Charlotte's debut on Dribbble. You can find this concept <a href="http://dribbble.com/shots/1253484-Post-Count-Achievements">here</a>. We've not actually developed the iOS app concept into reality, but that's a future goal... when we find an iOS developer.
		<br><br>
		Charlotte kidnapped Johannes (@jvimedia) and made him host the site.
		<br><br>
		We wrote the web app in October 2013. It wasn't exactly the best thing in the world, but it worked.
		<br><br>
		After that, Charlotte and Johannes (who got roped in somehow...) found Hugo (@hu) in November. He wrote the Post Count Achievement thing to be useful! It was pretty good before (it wasn't), but afterwards it was even better! ;)
		<br><br>
		We "bootstrapped" it in February 2014. After that, we retired the old site, and switched all our work to the new site. We don't update the old one any more.
		<br><br>
		Future ideas and suggestions can be emailed to <a href="mailto:purplapp@hry.jvimedia.co.uk?Subject=I%20have%20an%20idea%20for%20Purplapp%20" target="_top">this address</a>. Alternatively, you could file an issue on our <a href="http://github.com/purplapp/purplapp">GitHub repository</a>.
	</p>
</div>

<div class="col-md-6">
	<h2>Team</h2>
	<h4>Lead Team:</h4>
	<ul class="list-unstyled">
		<li>Charlotte W. (<a href="https://alpha.app.net/charl">@charl</a>)</li>
		<li>Johannes V. (<a href="https://alpha.app.net/jvimedia">@jvimedia</a>)</li>
	</ul>
	<h4>Contributors:</h4>
	<ul class="list-unstyled">
		<li>Hugo (<a href="https://alpha.app.net/hu">@hu</a>)</li>
		<li>Brandon (<a href="https://alpha.app.net/remus">@remus</a>)</li>
		<li>Jessica Dennis (<a href="https://alpha.app.net/jessicadennis">@jessicadennis</a>)</li>
	</ul>

	<h2>Credits</h2>
    <ul class='list-unstyled'>
    	<li>Font Awesome by Dave Gandy - <a href="http://fontawesome.io">fontawesome.io</a></li>
		<li>PCA Icons by Yusuke Kamiyamane - <a href="http://p.yusukekamiyamane.com">p.yusukekamiyamane.com</a></li>
		<li>Glyphicon Halflings by Glyphicons - <a href="http://glyphicons.com">glyphicons.com</a></li>
	</ul>
	 
	<h2>Other Stuff</h2>
	<ul class='list-unstyled'>
	    <li>We have to display an imprint, so here is our <a href="images/imprint.png">imprint</a>.</li>
	</ul>
</div>

<?php 
  } else {
    include('./include/header_unauth.php'); 
?>

<div class="col-md-12">
	<div class="page-header">
	  <h1>About Purplapp <small> &copy; 2013-<?php echo date("Y") ?></small></h1>
	</div>
</div>

<div class="col-md-6">
	<h2>The Idea</h2>
	<p>
		Purplapp was first conceived by Charlotte (@charl) in September 2013. You can see the posts on App.net about the idea <a href="https://alpha.app.net/charl/post/11384578">here</a>.
		<br><br>
		From that, an iOS app concept was produced and uploaded as Charlotte's debut on Dribbble. You can find this concept <a href="http://dribbble.com/shots/1253484-Post-Count-Achievements">here</a>. We've not actually developed the iOS app concept into reality, but that's a future goal... when we find an iOS developer.
		<br><br>
		Charlotte kidnapped Johannes (@jvimedia) and made him host the site.
		<br><br>
		We wrote the web app in October 2013. It wasn't exactly the best thing in the world, but it worked.
		<br><br>
		After that, Charlotte and Johannes (who got roped in somehow...) found Hugo (@hu) in November. He wrote the Post Count Achievement thing to be useful! It was pretty good before (it wasn't), but afterwards it was even better! ;)
		<br><br>
		We "bootstrapped" it in February 2014. After that, we retired the old site, and switched all our work to the new site. We don't update the old one any more.
		<br><br>
		Future ideas and suggestions can be emailed to <a href="mailto:purplapp@hry.jvimedia.co.uk?Subject=I%20have%20an%20idea%20for%20Purplapp%20" target="_top">this address</a>. Alternatively, you could file an issue on our <a href="http://github.com/purplapp/purplapp">GitHub repository</a>.
	</p>
</div>

<div class="col-md-6">
	<h2>Team</h2>
	<h4>Lead Team:</h4>
	<ul class="list-unstyled">
		<li>Charlotte W. (<a href="https://alpha.app.net/charl">@charl</a>)</li>
		<li>Johannes V. (<a href="https://alpha.app.net/jvimedia">@jvimedia</a>)</li>
	</ul>
	<h4>Contributors:</h4>
	<ul class="list-unstyled">
		<li>Hugo (<a href="https://alpha.app.net/hu">@hu</a>)</li>
		<li>Brandon (<a href="https://alpha.app.net/remus">@remus</a>)</li>
		<li>Jessica Dennis (<a href="https://alpha.app.net/jessicadennis">@jessicadennis</a>)</li>
	</ul>

	<h2>Credits</h2>
    <ul class='list-unstyled'>
    	<li>Font Awesome by Dave Gandy - <a href="http://fontawesome.io">fontawesome.io</a></li>
		<li>PCA Icons by Yusuke Kamiyamane - <a href="http://p.yusukekamiyamane.com">p.yusukekamiyamane.com</a></li>
		<li>Glyphicon Halflings by Glyphicons - <a href="http://glyphicons.com">glyphicons.com</a></li>
	</ul>
	 
	<h2>Other Stuff</h2>
	<ul class='list-unstyled'>
	    <li>We have to display an imprint, so here is our <a href="images/imprint.png">imprint</a>.</li>
	</ul>
</div>

<?php
  }
  include('include/footer.php');
?>