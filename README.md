Purplapp
========

[Purplapp](http://app.net/purplapp) is an app.net web statistics application.

### Configuration

Put it on a server with PHP.

That's pretty much it. Make sure that you change the `[APP_CLIENT_ID]` and `[APP_CLIENT_SECRET]`... You can change those settings in `phplib/PurplappSettings.php`.

```
$app_clientId     = '[APP_CLIENT_ID]';
$app_clientSecret = '[APP_CLIENT_SECRET]';
```

You need to setup this information using data from from [your app listings](https://account.app.net/developer/apps/). 
