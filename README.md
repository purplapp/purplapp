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

## Configuration

```bash
# clone the repo
git clone git@github.com:purplapp/purplapp.git && cd purplapp

# Install composer. If you've got it already, skip this step
curl -sS https://getcomposer.org/installer | php

# install dependencies
php composer.phar install

# create a .env file with your ADN keys
cp .env.example .env
# edit that file
$EDITOR .env
```

That's all the preparation it needs. Run your server of choice (`php -S
localhost:4000` is an easy way of starting) and pull up the app in your browser.

You need to setup this information using data from from [your app listings](https://account.app.net/developer/apps/).

## Tests

Tests are written using [Codeception][codecept], but are run through
[RoboTask][robo]. Once you've run composer you can run `./bin/robo test` to run
the full test suite.

[codecept]: http://codeception.com/
[robo]: http://robo.li/
