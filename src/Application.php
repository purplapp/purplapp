<?php namespace Purplapp;

use Silex\Application as BaseApplication;
use Silex\Application\TwigTrait;
use Silex\Application\UrlGeneratorTrait;

class Application extends BaseApplication {
    use TwigTrait;
    use LogTrait;
    use UrlGeneratorTrait;
}
