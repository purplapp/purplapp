<?php namespace Purplapp

class Container
{
    static $instances = array();

    static $params = array();

    public static function getSess()
    {
        return static::get("sess") ?: static::set("sess", static::createSess());
    }

    public static function getTwig()
    {
        return static::get("twig") ?: static::set("twig", static::createTwig());
    }

    public static function storeEnvParam($var)
    {
        static::storeParam($var, getenv($var));
    }

    public static function storeParam($key, $var)
    {
        static::$params[$key] = $var;
    }

    public static function getParam($key, $default = null)
    {
        return isset(static::$params[$key]) ? static::$params[$key] : $default;
    }

    public static function get($key, $default = null)
    {
        return isset(static::$instances[$key]) ? static::$instances[$key] : $default;
    }

    public static function set($key, $val)
    {
        return static::$instances[$key] = $val;
    }

    private static function createTwig()
    {
        $app = static::getSess();
        $loader = new Twig_Loader_Filesystem(app_dir() . "/views");

        $twig = new Twig_Environment(
            $loader,
            array(
                'debug' => true,
                'cache' => app_dir() . "/cache",
                "strict_variables" => true
            )
        );

        $twig->addExtension(new Twig_Extension_Debug());

        return $twig;
    }

    private static function createSess()
    {
        return new EZAppDotNet();
    }
}
