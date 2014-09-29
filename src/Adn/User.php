<?php namespace Purplapp\Adn;

use Carbon\Carbon;

class User
{
    use DataContainerTrait;
    use TimeSinceCreatedTrait;

    private $clubs;

    private $bio;

    public function init()
    {
        $this->clubs = new PostClubCollection($this);
        $this->bio   = new TextWithEntities(
            $this->description->text,
            $this->description->entities
        );
    }

    public function htmlBio()
    {
        return $this->bio->html();
    }

    public function clubs()
    {
        return $this->clubs;
    }
}
