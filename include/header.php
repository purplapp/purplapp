<!DOCTYPE html>
    <?php date_default_timezone_set('UTC'); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<base href="http://<?php echo $_SERVER['HTTP_HOST'].$base_path;?>" />

    <!-- Icons -->
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon-precomposed.png"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://jvimedia.org/static/bootstrap-3.1.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://jvimedia.org/static/bootstrap-3.1.1/css/bootstrap.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://jvimedia.org/static/font-awesome-4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://jvimedia.org/static/font-awesome-4.0.3/css/font-awesome.min.css"/>

    <!-- Bootstrap Core Custom CSS -->
    <link rel="stylesheet" href="https://jvimedia.org/static/bootstrap/css/bootstrap-fugue-min.css"/>

    <!-- Modifications -->
 <link rel="stylesheet" href="/css/mod.css">
    <!-- Humans.TXT -->
    <link rel="author" href="/humans.txt"/>
  
    <title><?php echo $title; ?></title>   
    
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
   

  <body>
  		<!-- Static navbar -->
	    <div class="navbar navbar-default navbar-static-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Purplapp</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
							<li><a href="/account.php"><i class="fa fa-user fa-fw"></i>Account Tools</a></li>
					<li><a href="/broadcast.php"><i class="fa fa-bolt fa-fw"></i>Broadcast Tools</a></li>
					<li><a href="/donate.php"><i class="fa fa-bitcoin fa-fw"></i>Donate</a></li>
					<li><a href="/about.php"><i class="fa fa-info fa-fw"></i>About</a></li>
				</ul>
                <ul class="nav navbar-nav navbar-right">