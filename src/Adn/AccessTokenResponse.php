<?php namespace Purplapp\Adn;

use GuzzleHttp\Message\Response;

class AccessTokenResponse
{
    private $data;

    public function __construct(Response $response)
    {
        $this->data = $response->json(["object" => true]);
    }

    public function __get($key)
    {
        return $this->data->$key;
    }
}
