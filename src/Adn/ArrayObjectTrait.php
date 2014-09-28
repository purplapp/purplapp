<?php namespace Purplapp\Adn;

trait ArrayObjectTrait
{
    use DataContainerTrait;

    /**
     * @var StdObject
     */
    private $data;

    public static function arrayWrap(array $array)
    {
        return new static($array);
    }

    public function __construct(array $array)
    {
        $this->data = $array;

        $this->init();
    }

    protected function init()
    {
        // can be overriden to allow initialization
    }
}
