<?php namespace Purplapp\Adn;

use stdClass;
use PhpOption\Option;

class TextWithEntities
{
    /**
     * @var string
     */
    private $text;

    /**
     * @var stdObject
     */
    private $entities;

    /**
     * A list of things to apply
     *
     * @var array
     */
    private $filters = [];

    public function __construct($text, stdClass $entities)
    {
        $this->text = $text;
        $this->entities = $entities;
    }

    public function html()
    {
        return Option::fromValue([$this->text, $this->entities])
            ->map([$this, "gatherHashtags"])
            ->map([$this, "gatherLinks"])
            ->map([$this, "gatherMentions"])
            ->map([$this, "encodeHtmlEntities"])
            ->map([$this, "applyFilters"])
            ->map(function ($arr) {
                return $arr[0];
            })
            ->map("nl2br")
            ->get();
    }

    public function encodeHtmlEntities(array $data)
    {
        list($text, $entities) = $data;

        return [htmlspecialchars($text, ENT_NOQUOTES, 'UTF-8'), $entities];
    }

    public function gatherHashtags(array $data)
    {
        list($text, $entities) = $data;

        foreach ($entities->hashtags as $hashtag) {
            $hashtagText = $this->getEntityText($text, $hashtag);
            $anchor = $this->createHashtagAnchor($hashtag->name, $hashtagText);

            $this->filters[] = function ($text) use ($hashtagText, $anchor) {
                //FIXME - Why aren't we using str_replace here
                return preg_replace("/" . preg_quote($hashtagText) . "\b/", $anchor, $text, 1);
            };

        }

        return $data;
    }

    public function gatherLinks(array $data)
    {
        list($text, $entities) = $data;

        $processed = [];

        foreach ($entities->links as $link) {
            $linkText = htmlentities($this->getEntityText($text, $link));
            $anchor = $this->createAnchorTag(htmlspecialchars($link->url), $linkText);

            if (in_array($linkText, $processed)) {
                continue;
            }

            $processed[] = $linkText;

            $this->filters[] = function ($text) use ($linkText, $anchor) {
                return str_replace($linkText, $anchor, $text);
            };
        }

        return $data;
    }

    public function gatherMentions(array $data)
    {
        list($text, $entities) = $data;

        $originalText = $text;

        foreach ($entities->mentions as $mention) {
            $mentionText = $this->getEntityText($originalText, $mention);
            $anchor = $this->createUserAnchor($mention->name, $mentionText);

            $this->filters[] = function ($text) use ($mentionText, $anchor) {
                return preg_replace("/" . preg_quote($mentionText, "/") . "\b/", $anchor, $text, 1);
            };
        }

        return $data;
    }

    public function applyFilters(array $data)
    {
        list($text, $entities) = $data;

        foreach ($this->filters as $filter) {
            $text = $filter($text);
        }

        return [$text, $entities];
    }

    public function getEntityText($text, $entity)
    {
        return mb_substr($text, $entity->pos, $entity->len, "UTF-8");
    }

    public function createAnchorTag($url, $text)
    {
        return "<a href=\"{$url}\">{$text}</a>";
    }

    public function createHashtagAnchor($hashtag, $text)
    {
        return $this->createAnchorTag("https://alpha.app.net/hashtags/{$hashtag}", $text);
    }

    public function createUserAnchor($username, $text)
    {
        return $this->createAnchorTag("https://alpha.app.net/{$username}", $text);
    }
}
