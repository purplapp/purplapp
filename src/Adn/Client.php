<?php namespace Purplapp\Adn;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Log\LoggerInterface;

class Client
{
    public $accessTokenUrl = "https://account.app.net/oauth/access_token";

    public $userResourceUrl = "https://api.app.net/users/";

    /**
     * @var Cache
     */
    protected $cache = [];

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * Constructs a new Client object
     *
     * @param string          $id           The client ID to use
     * @param string          $secret       The client secret to use
     * @param string          $redirect     The redirect URL to use
     * @param LoggerInterface $logger       A logger to log things with
     * @param GuzzleClient    $client       A Guzzle Client to make requests with
     * @param string          $accessToken  The access token to use for auth'd requests
     */
    public function __construct(
        $id,
        $secret,
        $redirect,
        LoggerInterface $logger,
        GuzzleClient $client = null,
        $accessToken
    ) {
        $this->id          = $id;
        $this->secret      = $secret;
        $this->redirect    = $redirect;
        $this->logger      = $logger;
        $this->client      = $client;
        $this->accessToken = $accessToken;

        $this->cache = new Cache();
    }

    public function getAccessToken($code)
    {
        $resp = AccessTokenResponse::responseWrap($this->client->post($this->accessTokenUrl, [
            "body" => [
                "client_id"     => $this->id,
                "client_secret" => $this->secret,
                "redirect_uri"  => $this->redirect,
                "grant_type"    => "authorization_code",
                "code"          => $code,
            ],
        ]));

        $this->accessToken = $resp->access_token;

        return $resp;
    }

    public function getAuthorizedUser(array $opts = [])
    {
        return $this->cache->get("authorized_user", function () use ($opts) {
            $url = $this->userResourceUrl . "/me" . $this->buildQuery($opts);

            return User::responseWrap($this->authGet($url));
        });
    }

    public function getAuthorizedUserPosts(array $opts = [])
    {
        $url = $this->userResourceUrl . "/me/posts" . $this->buildQuery($opts);

        return PostCollection::responseWrap($this->authGet($url));
    }

    public function getAuthorizedUserMentions(array $opts = [])
    {
        $url = $this->userResourceUrl . "/me/mentions" . $this->buildQuery($opts);

        return MentionCollection::responseWrap($this->authGet($url));
    }

    protected function authGet($url, array $opts = [])
    {
        return $this->client->get($url, [
            "headers" => ["Authorization" => "Bearer {$this->accessToken}"],
        ] + $opts);
    }

    protected function buildQuery(array $opts = [])
    {
        if (!$opts) {
            return "";
        }

        $final = [];

        array_walk($opts, function ($value, $key) {
            $final[$key] = !is_bool($value) ? $value : (int) $value;
        });

        return "?" . implode(",", $final);
    }
}
