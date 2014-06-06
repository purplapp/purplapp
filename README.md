Purplapp
========

[Purplapp](http://app.net/purplapp) is an app.net web statistics application.

### Configuration

Put it on a server with PHP.

That's pretty much it. Make sure that you change the `[APP_CLIENT_ID]` and `[APP_CLIENT_SECRET]`, as well as adding in the `[YOUR_DOMAIN]` base redirect URI... You can change those settings in `ADN_php/EZsettings.php`.

```
$app_clientId     = '[APP_CLIENT_ID]';
$app_clientSecret = '[APP_CLIENT_SECRET]';

$app_redirectUri  = 'http://[YOUR_DOMAIN]/ADN_php/callback.php';
```

You need to setup this information using data from from [your app listings](https://account.app.net/developer/apps/). 
