<?php namespace Purplapp\Adn;

use stdClass;
use GuzzleHttp\Message\Response;

trait DataContainerTrait
{
    private $data = [];

    private $dataEnvelope = [];

    public static function wrap($data)
    {
        if ($data instanceof stdClass) {
            return static::wrapObject($data);
        } elseif ($data instanceof Response) {
            return static::wrapResponse($data);
        } elseif (is_array($data)) {
            return static::wrapArray($data);
        }

        throw new InvalidArgumentException(gettype($data) . " is not a valid wrappable");
    }

    private static function wrapObject(stdClass $object)
    {
        return new static($object);
    }

    private static function wrapResponse(Response $response)
    {
        return new static($response->json(["object" => true])->data);
    }

    private static function wrapArray(array $array)
    {
        return new static((object) $array);
    }

    public function __construct($data)
    {
        $this->data = $data;

        $this->init();
    }

    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->$key();
        }

        return $this->data->$key;
    }

    public function __isset($key)
    {
        return method_exists($this, $key) || isset($this->data->$key);
    }

    public function init()
    {
        // no-op
    }
}
