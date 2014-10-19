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

    public function locale()
    {
        $this->locale = new Locale($this->data->locale);
        
        // var_dump($this->data->locale);
        // var_dump($this->locale);

        return $this->locale;
    }
}
