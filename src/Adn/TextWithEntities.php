<?php namespace Purplapp\Adn;

use \stdClass;

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

    public function __construct($text, stdClass $entities)
    {
        $this->text = $text;
        $this->entities = $entities;
    }

    public function html()
    {
        return Option::fromValue([$this->text, $this->entities])
            ->map([$this, "encodeHtmlEntities"])
            ->map([$this, "processHashtags"])
            ->map([$this, "processLinks"])
            ->map([$this, "processMentions"])
            ->get();
    }

    private function encodeHtmlEntites(array $data)
    {
        list($text, $entities) = $data;

        return [htmlentities($text, 0, 'UTF-8'), $entities];
    }

    private function processHashtags(array $data)
    {
        list($text, $entities) = $data;

        foreach ($entities->hashtags as $hashtag) {
            $hashtagText = $this->getEntityText($text, $hashtag);

            //FIXME - Why aren't we using str_replace here
            $text = preg_replace(
                "/" . preg_quote($hashtagText) . "\b/",
                $this->createHashtagAnchor($entity->name, $hashtagText),
                $text,
                1
            );
        }

        return [$text, $entities];
    }

    private function processLinks(array $data)
    {
        list($text, $entities) = $data;

        $processed = [];

        foreach ($entities->links as $link) {
            $linkText = htmlentities($this->getEntityText($text, $link));

            if (in_array($linkText, $processed)) {
                continue;
            }

            $processed[] = $linkText;

            $text = str_replace(
                $linkText,
                $this->createAnchorTag(htmlspecialchars($link->url), $linkText),
                $text
            );
        }

        return [$text, $entities];
    }

    private function processMentions(array $data)
    {
        list($text, $entities) = $data;

        foreach ($entities->mentions as $mention) {
            $mentionText = $this->getEntityText($text, $mention);

            $text = preg_replace(
                "/" . preg_quote($mentionText) . "\b/",
                $this->createUserAnchor($mention->name, $mentionText),
                $text,
                1
            );
        }

        return [$text, $entities];
    }

    private function getEntityText($text, $entity)
    {
        return mb_substr($text, $entity->pos, $entity->len);
    }

    private function createAnchorTag($url, $text)
    {
        return "<a href=\"{$url}\">{$text}</a>";
    }

    private function createHashtagAnchor($hashtag, $text)
    {
        return $this->createAnchorTag("https://alpha.app.net/hashtags/{$hashtag}", $text);
    }

    private function createUserAnchor($username, $text)
    {
        return $this->createAnchorTag("https://alpha.app.net/{$username}", $text);
    }
}
