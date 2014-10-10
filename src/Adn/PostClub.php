<?php namespace Purplapp\Adn;

class PostClub
{
    use DataContainerTrait;

    public function html()
    {
        return "<a href=\"https://alpha.app.net/hashtags/{$this->url}\">{$this->name()}</a>"
            . " <i>({$this->niceCount()} posts)</i>";
    }

    public function niceCount()
    {
        return number_format($this->count, 0, ".", " ");
    }

    public function name()
    {
        return "#{$this->url}";
    }
}
