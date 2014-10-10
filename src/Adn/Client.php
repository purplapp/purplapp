<?php namespace Purplapp\Adn;

use GuzzleHttp\Client as GuzzleClient;
use Psr\Log\LoggerInterface;

/**
 * An App.net client
 */
class Client
{
    /**
     * @var string
     */
    public $accessTokenUrl     = "https://account.app.net/oauth/access_token";

    /**
     * @var string
     */
    public $authCallbackUrl    = "https://account.app.net/oauth" ;

    /**
     * @var string
     */
    public $userResourceUrl    = "https://api.app.net/users";

    /**
     * @var string
     */
    public $postResourceUrl    = "https://api.app.net/posts";

    /**
     * @var string
     */
    public $channelResourceUrl = "https://api.app.net/channels";

    /**
     * @var Cache
     */
    protected $cache = [];

    /**
     * @var GuzzleHttp\Client
     */
    protected $client;

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

    /**
     * Returns the URL to use for redirect-style authentication requests
     *
     * @param $callbackUri string
     * @param $scope array
     *
     * @return string
     */
    public function getAuthUrl($callbackUri, array $scope = [])
    {
        $data = [
            "client_id"     => $this->id,
            "response_type" => "code",
            "redirect_uri"  => $callbackUri,
        ];

        $opts = $scope ? ["scope" => implode("+", $scope)] + $data : $data;

        $base = $this->authCallbackUrl . "/" . ($this->accessToken ? "authorize" : "authenticate");

        return $base . $this->buildQuery($opts);
    }

    /**
     * Retrieves an ADN access token from the API
     *
     * @param $code string
     *
     * @return AccessToken
     */
    public function getAccessToken($code)
    {
        $resp = AccessToken::wrap($this->client->post($this->accessTokenUrl, [
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

    /**
     * Gets a User that matches the chosen identifier
     *
     * @param $user mixed the identifier to search for
     * @param $opts array the options to use when retrieving the User
     *
     * @return User
     */
    public function getUser($user, array $opts = [])
    {
        $base = $this->userResourceUrl . "/{$this->normalizeUserIdentifier($user)}";

        $url = $base . $this->buildQuery($this->getDefaultUserOpts() + $opts);

        return User::wrap($this->authGet($url));
    }

    /**
     * Gets multiple users that match the chosen identifiers
     *
     * @param $users array the identifiers to search for
     * @param $opts  array the options to use when retrieving the Users
     *
     * @return UserCollection
     */
    public function getUsers(array $users, array $opts = [])
    {
        $options = ["ids" => $users] + $this->getDefaultUserOpts() + $opts;

        $url = "{$this->userResourceUrl}/{$this->buildQuery($options)}";

        return UserCollection::wrap($this->authGet($url));
    }

    /**
     * Gets the currently-authenticated User
     *
     * @param $opts array
     *
     * @return User
     */
    public function getAuthorizedUser(array $opts = [])
    {
        return $this->cache->get("authorized_user", function () use ($opts) {
            $base = $this->userResourceUrl . "/me";
            $url = $base . $this->buildQuery($this->getDefaultUserOpts() + $opts);

            return User::wrap($this->authGet($url));
        });
    }

    /**
     * Gets the currently-authenticated User's posts
     *
     * @param $opts array
     *
     * @return PostCollection
     */
    public function getAuthorizedUserPosts(array $opts = [])
    {
        return $this->getUserPosts("me", $opts);
    }

    /**
     * Gets the selected User's posts
     *
     * @param $identifier mixed the identifier to search for
     * @param $opts array
     *
     * @return PostCollection
     */
    public function getUserPosts($identifier, array $opts = [])
    {
        $normalized = $this->normalizeUserIdentifier($identifier);

        $url = "{$this->userResourceUrl}/{$normalized}/posts" . $this->buildQuery($opts);

        return PostCollection::wrap($this->authGet($url));
    }

    /**
     * Gets the currently-authenticated User's mentions
     *
     * @param $opts array
     *
     * @return MentionCollection
     */
    public function getAuthorizedUserMentions(array $opts = [])
    {
        return $this->getUserMentions("me", $opts);
    }

    /**
     * Gets the selected User's mentions
     *
     * @param $identifier mixed the identifier to search for
     * @param $opts array
     *
     * @return MentionCollection
     */
    public function getUserMentions($identifier, array $opts = [])
    {
        $normalized = $this->normalizeUserIdentifier($username);

        $url = "{$this->userResourceUrl}/{$normalized}/mentions" . $this->buildQuery($opts);

        return MentionCollection::wrap($this->authGet($url));
    }

    /**
     * Gets the selected Channel
     *
     * @param $identifier string
     * @param $opts       array
     *
     * @return Channel
     */
    public function getChannel($identifier, array $opts = [])
    {
        $base = "{$this->channelResourceUrl}/{$identifier}";

        $url = $base . $this->buildQuery($this->getDefaultChannelOpts() + $opts);

        return Channel::wrap($this->client->get($url));
    }

    /**
     * Gets the selected Channel's Messages
     *
     * @param $identifier string
     * @param $opts       array
     *
     * @return MessageCollection
     */
    public function getChannelMessages($identifier, array $opts = [])
    {
        $base = "{$this->channelResourceUrl}/{$identifier}/messages";

        $url = $base . $this->buildQuery($this->getDefaultMessageOpts() + $opts);

        return MessageCollection::wrap($this->client->get($url));
    }

    /**
     * Searches for posts matching the provided options
     *
     * @param $opts array
     *
     * @return PostCollection
     */
    public function searchPosts(array $opts = [])
    {
        $base = "{$this->postResourceUrl}/search";

        $url =  $base . $this->buildQuery($this->getDefaultSearchOpts() + $opts);

        return PostCollection::wrap($this->authGet($url));
    }

    /**
     * Gets the currently-authorized User's followers IDs
     *
     * @param $opts array
     *
     * @return NumberCollection
     */
    public function getAuthorizedUserFollowerIds(array $opts = [])
    {
        return $this->getUserFollowerIds("me", $opts);
    }

    /**
     * Gets the selected User's followers IDs
     *
     * @param $identifier mixed
     * @param $opts       array
     *
     * @return NumberCollection
     */
    public function getUserFollowerIds($identifier, array $opts = [])
    {
        $normalized = $this->normalizeUserIdentifier($identifier);

        $url = "{$this->userResourceUrl}/{$normalized}/follower/ids" . $this->buildQuery($opts);
        return NumberCollection::wrap($this->authGet($url));
    }

    /**
     * Gets the currently-authorized User's following IDs
     *
     * @param $opts array
     *
     * @return NumberCollection
     */
    public function getAuthorizedUserFollowingIds(array $opts = [])
    {
        return $this->getUserFollowingIds("me", $opts);
    }

    /**
     * Gets the selected User's following IDs
     *
     * @param $identifier mixed
     * @param $opts       array
     *
     * @return NumberCollection
     */
    public function getUserFollowingIds($identifier, array $opts = [])
    {
        $normalized = $this->normalizeUserIdentifier($identifier);

        $url = "{$this->userResourceUrl}/{$normalized}/following/ids" . $this->buildQuery($opts);

        return NumberCollection::wrap($this->authGet($url));
    }

    /**
     * Attempts to follow the provider user
     *
     * @param $user mixed
     *
     * @return GuzzleHttp\Message\Response
     */
    public function followUser($user)
    {
        $identifier = $this->normalizeUserIdentifier($user);

        $url = "{$this->userResourceUrl}/{$identifier}/follow";

        return $this->authPost($url);
    }

    /**
     * Attempts to unfollow the provider user
     *
     * @param $user mixed
     *
     * @return GuzzleHttp\Message\Response
     */
    public function unfollowUser($user)
    {
        $identifier = $this->normalizeUserIdentifier($user);

        $url = "{$this->userResourceUrl}/{$identifier}/follow";

        return $this->authDelete($url);
    }

    /**
     * Makes an authenticated GET request to the provided URL
     *
     * @param $url  string
     * @param $opts array
     *
     * @return GuzzleHttp\Message\Response
     */
    protected function authGet($url, array $opts = [])
    {
        return $this->authHttpRequest("get", $url, $opts);
    }

    /**
     * Makes an authenticated POST request to the provided URL
     *
     * @param $url  string
     * @param $opts array
     *
     * @return GuzzleHttp\Message\Response
     */
    protected function authPost($url, array $opts = [])
    {
        return $this->authHttpRequest("post", $url, $opts);
    }

    /**
     * Makes an authenticated DELETE request to the provided URL
     *
     * @param $url  string
     * @param $opts array
     *
     * @return GuzzleHttp\Message\Response
     */
    protected function authDelete($url, array $opts = [])
    {
        return $this->authHttpRequest("delete", $url, $opts);
    }

    /**
     * Makes an authenticated request of the chosen type to the provided URL
     *
     * @param $method  string
     * @param $url     string
     * @param $opts    array
     *
     * @return GuzzleHttp\Message\Response
     */
    protected function authHttpRequest($method, $url, array $opts = [])
    {
        return $this->client->$method($url, [
            "headers" => ["Authorization" => "Bearer {$this->accessToken}"],
        ] + $opts);
    }

    /**
     * Builds a query string for the provided options
     *
     * @param $opts array
     *
     * @return string
     */
    protected function buildQuery(array $opts = [])
    {
        if (!$opts) {
            return "";
        }

        $final = [];

        foreach ($opts as $key => $value) {
            if (is_bool($value)) {
                $final[] .= "{$key}=" . (int) $value;
            } else if (is_array($value)) {
                $final[] = "{$key}=" . implode(",", $value);
            } else {
                $final[] = "{$key}={$value}";
            }
        }

        return "?" . implode("&", $final);
    }

    /**
     * Normalizes user identifiers to strings that the ADN API understands
     *
     * @param $identifier mixed
     *
     * @return string
     */
    protected function normalizeUserIdentifier($identifier)
    {
        if ($identifier instanceof User) {
            return $identifier->id;
        }

        if (is_array($identifier)) {
            return implode(",", array_map([$this, "normalizeUserIdentifier"], $identifier));
        }

        if (is_numeric($identifier)) {
            return $identifier;
        }

        if ($identifier === "me") {
            return $identifier;
        }

        return "@" . trim($identifier, "@ ");
    }

    /**
     * The default options to use when retrieving users
     *
     * @return array
     */
    private function getDefaultUserOpts()
    {
        return [
            "include_annotations"      => true,
            "include_user_annotations" => true,
            "include_html"             => true,
        ];
    }

    /**
     * The default options to use when retrieving channels
     *
     * @return array
     */
    private function getDefaultChannelOpts()
    {
        return [
            'include_annotations' => true,
            'channel_types'       => 'net.app.core.broadcast',
            'include_inactive'    => true,
        ];
    }

    /**
     * The default options to use when retrieving messages
     *
     * @return array
     */
    private function getDefaultMessageOpts()
    {
        return [
            'include_message_annotations' => true,
            'include_user_annotations'    => false,
        ];
    }

    /**
     * The default options to use when searching
     *
     * @return array
     */
    private function getDefaultSearchOpts()
    {
        return [
            'include_post_annotations' => true,
            "order" => "id",
        ];
    }
}
