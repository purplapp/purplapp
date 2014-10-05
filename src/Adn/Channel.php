<?php namespace Purplapp\Adn;

/**
 * A data container object that represents a Channel
 */
class Channel
{
    use DataContainerTrait;

    /**
     * returns the title, which is usually embedded in metadata annotations
     *
     * @return string
     */
    public function title()
    {
        foreach ($this->annotations as $annotation) {
            if ($annotation->type === "core.broadcast.metadata") {
                return $annotation->value->title;
            }
        }
    }
}
