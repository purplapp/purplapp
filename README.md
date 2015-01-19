Purplapp [![Build Status][ci img]][ci link] [![Code Climate][cc img]][cc link] [![Test Coverage][tc img]][cc link]
==================================================================================================================

[ci img]: https://img.shields.io/travis/purplapp/purplapp/master.svg?style=flat
[cc img]: https://img.shields.io/codeclimate/github/purplapp/purplapp.svg?style=flat
[tc img]: https://img.shields.io/codeclimate/coverage/github/purplapp/purplapp.svg?style=flat

[ci link]: https://travis-ci.org/purplapp/purplapp
[cc link]: https://codeclimate.com/github/purplapp/purplapp

>An [App.net](https://app.net/) statistics application.

## Features

### Account Features

- Find details on your account and your PCA Clubs.

- Find the first mentions between two users.

- Compare your followers with that of another user.

### Broadcast Features

- See the most recent 5 updates in any Broadcast channel.

### Want to suggest a feature?

Visit the issue page of this repository and open a new issue
with the feature(s) you want to have added to Purplapp!

Alternatively, fork this repo and setup a local version of
Purplapp and add a feature! Make sure you add tests, and that
they pass before you file a pull request!

## Setup

### Getting the code

```bash
# clone the repo
git clone git@github.com:purplapp/purplapp.git && cd purplapp

# Install composer. If you've got it already, skip this step
curl -sS https://getcomposer.org/installer | php

# install php dependencies
php composer.phar install

# run various setup tasks
./bin/robo clean
./bin/robo assets
./bin/robo test
```

### Configuration

You'll need to get or create a client ID and client secret. You can get this
information from [your App.net app listings](https://account.app.net/developer/apps/).

If you want to get statistics from GitHub, you'll need to get or create
a GitHub personal access token. Information on scopes required is coming soon,
but the defaults are probably good for now. You can get this information from
[your applications tab](https://github.com/settings/tokens/new). You'll also
need to change all the mentions of purplapp [in this block of
code](https://github.com/purplapp/purplapp/blob/master/start/routes.php#L274-L326)
to your own organisation/user and repository name.

**App configuration is handled via a `.config` file in the root. Copy the
`.config.example` file and fill in your details there.**

If you're developing on Purplapp, make sure that in the `.config` file it's set
to `DEBUG=1`, not `DEBUG=0`; on a production server, make sure it's set to
`DEBUG=0` to avoid potential revealing of sensitive data (client secrets, etc.)
to the end user.

If you'd like push notifications via Pushover, fill out the appropriate settings
in `.config`.

### Server

Purplapp will run on most servers. It's currently deployed to an Apache
instance, but nginx or the built-in PHP server should work just as well. The
built-in PHP server is good for testing.

## Development

Many development tasks are handled by [Robo](http://robo.li/). You can run `./bin/robo`
to find out which tasks are available, or edit the RoboFile.php directly. Here's
a brief description of the most common tasks:

### serve

- `./bin/robo serve` starts a development server running on <127.0.0.1:8083>.

### clean

- `./bin/robo clean` cleans the filesystem cache.

### assets

- `./bin/robo assets` writes all the Twig-specified assets in every template to
  its appropriate location in the public directory

  NOTE: This uses the Google Closure Compiler web API, so internet access is
  required.

### test

- `./bin/robo test` runs the full test suite.

  NOTE: Tests are written in PHPUnit. Check the `tests` folder for some examples.

### coverage

- `./bin/robo coverage` runs the full test suite and generates an HTML coverage
  report in `./out/coverage/`.

  NOTE: Generating code coverage requires xdebug be installed. It's also really
  slow, so don't be surprised when it takes > 10x more time.

### tdd

- `./bin/robo tdd` runs the full test suite whenever any of the source files change.

### tags

- `./bin/robo tags` will generate the ctags file for the project

  NOTE: This requires the phptags binary be available in your $PATH.

## Contributors

* original concept by [charlw](https://github.com/charlw)

* majority of code written by [charlw](https://github.com/charlw),
  [ciarand](https://github.com/ciarand) and [humd](https://github.com/humd)

* hosting of [purplapp.eu](http://purplapp.eu) by
  [jvimedia](https://github.com/jvimedia)

* thanks to everyone else who has contributed to the codebase!

## License

Purplapp is licensed under the [MIT License](http://opensource.org/licenses/MIT).
