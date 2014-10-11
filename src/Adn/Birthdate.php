<?php namespace Purplapp\Adn;

use Carbon\Carbon;

class Birthdate
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var Carbon
     */
    private $date;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function format($string)
    {
        return $this->date()->format($string);
    }

    public function date()
    {
        if (!$this->date) {
            if ($this->hasYear()) {
                $this->date = Carbon::createFromFormat("Y-m-d", $this->value);
            } else {
                $this->date = Carbon::createFromFormat("m-d", substr($this->value, 5));
            }
        }

        return $this->date;
    }

    public function hasYear()
    {
        return strpos(strtolower($this->value), "xxxx") === false;
    }
}
