<?php namespace Purplapp\Adn;

trait PostWithEntitiesTrait
{
    use DataContainerTrait;

    private $processedText;

    public function init()
    {
        $this->processedText = new TextWithEntities($this->text, $this->entities);
    }

    public function html()
    {
        return $this->processedText->html();
    }
}
