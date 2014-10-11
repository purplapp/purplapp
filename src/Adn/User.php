<?php namespace Purplapp\Adn;

use Carbon\Carbon;

class User
{
    use DataContainerTrait;
    use TimeSinceCreatedTrait;
    use BirthdayTrait;

    private $clubs;

    private $bio;

    private $htmlBio;

    public function init()
    {
        $this->clubs = PostClubs::forUser($this);
        $this->bio   = new TextWithEntities(
            $this->description->text,
            $this->description->entities
        );
    }

    public function htmlBio()
    {
        if (!$this->htmlBio) {
            $this->htmlBio = $this->bio->html();
        }

        return $this->htmlBio;
    }

    public function clubs()
    {
        return $this->clubs;
    }
}
