<?php namespace Purplapp\Adn;

class Channel
{
    use DataContainerTrait;

    public function title()
    {
        foreach ($this->annotations as $annotation) {
            if ($annotation->type === "core.broadcast.metadata") {
                return $annotation->value->title;
            }
        }
    }
}
