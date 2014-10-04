<?php namespace Purplapp\Adn;

class NiceRankAwareClient extends Client
{
    public function getAuthorizedUserNiceRank(array $opts = [])
    {
        return $this->getUserNiceRank($this->getAuthorizedUser(), $opts);
    }

    public function getUserNiceRank(User $user, array $opts = [])
    {
        return $this->cache->get("user_nice_rank_{$user->id}", function () use ($user, $opts) {
            $url = "http://api.nice.social/user/nicerank" . $this->buildQuery([
                "ids"          => $user->id,
                "show_details" => true,
            ] + $opts);

            return NiceRankCollection::wrap($this->client->get($url));
        });
    }
}
