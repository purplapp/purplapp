<?php namespace Purplapp\Adn;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Log\LoggerInterface;

class Client
{
    public $accessTokenUrl = "https://account.app.net/oauth/access_token";

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $redirect;

    /**
     * @var GuzzleClient
     */
    private $client;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    public function __construct($id, $secret, $redirect, LoggerInterface $logger, GuzzleClient $client = null)
    {
        $this->id       = $id;
        $this->secret   = $secret;
        $this->redirect = $redirect;
        $this->logger   = $logger;

        $this->client   = $client ?: new GuzzleClient();
    }

    public function getAccessToken($code)
    {
        return new AccessTokenResponse($this->client->post($this->accessTokenUrl, [
            "body" => [
                "client_id"     => $this->id,
                "client_secret" => $this->secret,
                "redirect_uri"  => $this->redirect,
                "grant_type"    => "authorization_code",
                "code"          => $code,
            ],
        ]));
    }
}

