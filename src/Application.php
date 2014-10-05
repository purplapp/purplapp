<?php namespace Purplapp;

use Silex\Application as BaseApplication;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;
use Silex\Application\MonologTrait;

/**
 * A very simple child class that uses some Traits to enable easier logging,
 * templating, and url generation among others.
 */
class Application extends BaseApplication {
    use TwigTrait;
    use MonologTrait;
    use UrlGeneratorTrait;
}
