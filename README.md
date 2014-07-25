Purplapp
========

[Purplapp](http://app.net/purplapp) is an app.net web statistics application.

##Features
###Account Features
- Find details on your account and your PCA Clubs.
- Find the first mentions between two users.
- Compare your followers with that of another user.

###Broadcast Features
- See the most recent 5 updates in any Broadcast channel.

### Configuration

Put it on a server with PHP.

That's pretty much it. Make sure that you change the `[APP_CLIENT_ID]` and `[APP_CLIENT_SECRET]`... You can change those settings in `phplib/PurplappSettings.php`.

```
$app_clientId     = '[APP_CLIENT_ID]';
$app_clientSecret = '[APP_CLIENT_SECRET]';
```

You need to setup this information using data from from [your app listings](https://account.app.net/developer/apps/). 
