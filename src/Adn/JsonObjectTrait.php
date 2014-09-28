<?php namespace Purplapp\Adn;

use GuzzleHttp\Message\Response;

trait JsonObjectTrait
{
    use DataContainerTrait;

    /**
     * @var StdObject
     */
    private $data;

    /**
     * @var StdObject
     */
    private $dataEnvelope;

    public static function responseWrap(Response $response)
    {
        return new static($response);
    }

    public function __construct(Response $response)
    {
        $this->dataEnvelope = $response->json(["object" => true]);

        $this->data = $this->dataEnvelope->data;

        $this->init();
    }

    protected function init()
    {
        // can be overriden to allow initialization
    }
}
