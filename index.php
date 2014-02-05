<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Purplapp</title>

    <!-- header.php -->
    <?php include "include/header.php"; ?>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-static-top.css" rel="stylesheet">

    <!-- Modifications -->
    <link href="css/mod.css" rel="stylesheet">

    <!--adnjs-->
    <script>(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//d2zh9g63fcvyrq.cloudfront.net/adn.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'adn-button-js'));</script>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="col-md-6">
        <h1>What is Purplapp?</h1>
        <p>Purplapp is an app for App.net statistics, developed by <a href='https://app.net/charl' target='_blank'>@charl</a>, with help from <a href='https://app.net/jvimedia' target='_blank'>@jvimedia</a> and <a href='https://app.net/hu' target='_blank'>@hu</a>.</p>

        <h1>Like what we've done?</h1>
        <p>Check us out on <a href='http://github.com/purplapp'>Github</a>!</p>
        <p>It costs money to keep Purplapp going, and we want to continue bringing you new features we cannot currently. You can help us improve ADN by donating! :)</p>
        <script src="http://coinwidget.com/widget/coin.js"></script>
        <script>
          CoinWidgetCom.go({
            wallet_address: "1Phr61c451vK5T2iiKn7PfHim6U829foA7"
            , currency: "bitcoin"
            , counter: "count"
            , alignment: "btc"
            , qrcode: true
            , auto_show: false
            , lbl_button: "Donate"
            , lbl_address: "Our Bitcoin Address:"
            , lbl_count: "donations"
            , lbl_amount: "BTC"
          });
        </script>
        <br><br>
        <script src="http://coinwidget.com/widget/coin.js"></script>
        <script>
          CoinWidgetCom.go({
            wallet_address: "LPXzH5qVbFEHGwWUFCJX6AYwzFm6u6FVnX"
            , currency: "litecoin"
            , counter: "count"
            , alignment: "ltc"
            , qrcode: true
            , auto_show: false
            , lbl_button: "Donate"
            , lbl_address: "Our Litecoin Address:"
            , lbl_count: "donations"
            , lbl_amount: "LTC"
          });
        </script>
        <br /><br />
        <script id='fbz61pq'>(function(i){var f,s=document.getElementById(i);f=document.createElement('iframe');f.src='http://api.flattr.com/button/view/?uid=jvimedia&button=compact&url=http%3A%2F%2Fpurplapp.eu';f.title='Flattr';f.height=20;f.width=110;f.style.borderWidth=0;s.parentNode.insertBefore(f,s);})('fbz61pq');</script>
      </div>

      <div class="col-md-6">
        <h1>Features</h1>
        <h3>Current Features</h3>
        <ul>
          <li><a href='posts.php'>Find details on your account and your PCA Clubs.</a></li>
          <li><a href='pca.php'>Your PCA Clubs - formatted to easily copy into your bio.</a></li>
          <li><a href='spam.php'>Spammer Check - check if we think that a user is a spammer.</a></li>
        </ul>

        <h3>Upcoming Features</h3>
        <ul>
          <li>Auto-update your bio with current clubs you're in.</li>
          <li>Notifications from clubs you're in and on users who are close to joining clubs.</li>
        </ul>
      </div>

      <!-- footer.php -->
      <?php include "include/footer.php"; ?>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
