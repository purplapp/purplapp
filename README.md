Purplapp [![Build Status][ci img]][ci link]
========

[Purplapp](http://app.net/purplapp) is an app.net web statistics application.

[![Pull Request Stats][pr img]][pr link] [![Issue Stats][is img]][is link] [![Code Climate][cc img]][cc link]

[ci img]: https://travis-ci.org/purplapp/purplapp.svg?branch=master
[cc img]: https://codeclimate.com/github/purplapp/purplapp/badges/gpa.svg
[is img]: http://issuestats.com/github/purplapp/purplapp/badge/issue
[pr img]: http://issuestats.com/github/purplapp/purplapp/badge/pr

[ci link]: https://travis-ci.org/purplapp/purplapp
[is link]: http://issuestats.com/github/purplapp/purplapp
[pr link]: http://issuestats.com/github/purplapp/purplapp
[cc link]: https://codeclimate.com/github/purplapp/purplapp

## Features

### Account Features

- Find details on your account and your PCA Clubs.
- Find the first mentions between two users.
- Compare your followers with that of another user.

### Broadcast Features

- See the most recent 5 updates in any Broadcast channel.

## Setup

### Getting the code

```bash
# clone the repo
git clone git@github.com:purplapp/purplapp.git && cd purplapp

# Install composer. If you've got it already, skip this step
curl -sS https://getcomposer.org/installer | php

# install php dependencies
php composer.phar install
# install npm dependencies
npm install --dev
# install bower
npm install -g bower
# install bower dependencies
bower install
```

### Configuration

You'll need to get or create a client ID and client secret. You can get this
information from [your app listings](https://account.app.net/developer/apps/).

App configuration is handled via a `.env` file in the root. Copy the
`.env.example` file and fill in your details there.


### Server

Purplapp will run on most servers. It's currently deployed to an Apache
instance, but nginx or the built-in PHP server should work just as well.

## Development

Many development tasks are handled by the [Robo][robo]. You can run `./bin/robo`
to find out which tasks are available, or edit the RoboFile.php directly. Here's
a brief description of the most common tasks:

### gulp

- `./bin/robo gulp` starts the gulp build process.

### serve

- `./bin/robo serve` starts a development server running on <127.0.0.1:8083>.

### test

- `./bin/robo test` runs the full test suite.

- `./bin/robo test -- --debug` will run the test suite in debug mode.

### tdd

- `./bin/robo tdd` runs the full test suite whenever any of the source files
  change.

- `./bin/robo tdd -- --debug` will run the test suite in debug mode.


## Testing

Tests are written in PHPUnit. Check the `tests` folder for some examples.

[robo]: http://robo.li/
