<?php namespace Purplapp\Adn;

use Carbon\Carbon;

class User
{
    use DataContainerTrait;
    use TimeSinceCreatedTrait;

    private $clubs;

    private $bio;

    private $htmlBio;

    /**
     * @var Birthdate|null
     */
    private $birthdate = null;

    /**
     * @var Locale|null
     */
    private $locale = null;

    public function init()
    {
        $this->clubs = PostClubs::forUser($this);
        if (isset($this->description)) {
            $this->bio = new TextWithEntities(
                $this->description->text,
                $this->description->entities
            );
        }
    }

    public function htmlBio()
    {
        if (isset($this->bio)) {
            if (!$this->htmlBio) {
                $this->htmlBio = $this->bio->html();
            }

            return $this->htmlBio;
        }
    }

    public function clubs()
    {
        return $this->clubs;
    }

    /**
     * @return Birthdate
     */
    public function birthdate()
    {
        if (!$this->birthdate) {
            foreach ($this->annotations as $annotation) {
                if ($annotation->type === "com.appnetizens.userinput.birthday") {
                    $this->birthdate = new Birthdate($annotation->value->birthday);
                }
            }
        }

        return $this->birthdate;
    }

    /**
     * @return Locale
     */
    public function locale()
    {
        if (!$this->locale) {
            $this->locale = Locale::fromCode($this->data->locale);
        }

        return $this->locale;
    }
}
