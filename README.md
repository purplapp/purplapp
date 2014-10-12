Purplapp [![Build Status][ci img]][ci link]
========

[Purplapp](http://app.net/purplapp) is an app.net web statistics application.

[![Pull Request Stats][pr img]][pr link] [![Issue Stats][is img]][is link] [![Code Climate][cc img]][cc link] [![Test Coverage][tc img]][cc link]

[ci img]: https://travis-ci.org/purplapp/purplapp.svg?branch=master
[cc img]: https://codeclimate.com/github/purplapp/purplapp/badges/gpa.svg
[tc img]: https://codeclimate.com/github/purplapp/purplapp/badges/coverage.svg
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
# install bower
npm install -g bower
# install bower dependencies
bower install
```

### Configuration

You'll need to get or create a client ID and client secret. You can get this information from [your app listings](https://account.app.net/developer/apps/).

If you want to get statistics from GitHub, you'll need to get or create a GitHub personal access token. Information on scopes required is coming soon, but the defaults are probably good for now. You can get this information from [your applications tab](https://github.com/settings/tokens/new).

App configuration is handled via a `.env` file in the root. Copy the `.env.example` file and fill in your details there.

If you're developing on Purplapp, make sure that in the `.env` file it's set to `DEBUG=1`, not `DEBUG=0`.

### Server

Purplapp will run on most servers. It's currently deployed to an Apache instance, but nginx or the built-in PHP server should work just as well.

## Development

Many development tasks are handled by the [Robo][robo]. You can run `./bin/robo` to find out which tasks are available, or edit the RoboFile.php directly. Here's a brief description of the most common tasks:

### serve

- `./bin/robo serve` starts a development server running on <127.0.0.1:8083>.

### clean

- `./bin/robo clean` cleans the filesystem cache.

### assets

- `./bin/robo assets` writes all the Twig-specified assets in every template to its appropriate location in the public directory

  NOTE: This uses the Google Closure Compiler web API, so internet access is required

### test

- `./bin/robo test` runs the full test suite.

### coverage

- `./bin/robo coverage` runs the full test suite and generates an HTML coverage report in `./out/coverage/`.

  NOTE: Generating code coverage requires xdebug be installed. It's also really slow, so don't be surprised when it takes > 10x more time.

### tdd

- `./bin/robo tdd` runs the full test suite whenever any of the source files change.

### tags

- `./bin/robo tags` will generate the ctags file for the project

  NOTE: This requires the phptags binary be available in your $PATH
  
## Code Climate

If you've got Xdebug installed, you should run `bin/phpunit --coverage-clover build/logs/clover.xml`, and then `CODECLIMATE_REPO_TOKEN=[your_codeclimate_token] ./bin/test-reporter`.

The `CODECLIMATE_REPO_TOKEN` value is provided after you add your repo to your Code Climate account by clicking on "Setup Test Coverage" on the right hand side of the feed.

## Testing

Tests are written in PHPUnit. Check the `tests` folder for some examples.

[robo]: http://robo.li/
