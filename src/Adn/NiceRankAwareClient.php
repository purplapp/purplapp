<?php namespace Purplapp\Adn;

class NiceRankAwareClient extends Client
{
    public function getAuthorizedUserNiceRank(array $opts = [])
    {
        return $this->cache->get("authorized_user_nice_rank", function () use ($opts) {
            $user = $this->getAuthorizedUser();

            $url = "http://api.nice.social/user/nicerank" . $this->buildQuery([
                "ids"          => $user->id,
                "show_details" => true,
            ] + $opts);

            return NiceRankCollection::wrap($this->client->get($url));
        });
    }
}
