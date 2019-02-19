<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;

class PregMatchType extends AbstractAttribute
{
    protected $pattern = '';
    protected $patterns = [];

    public function setOptions($options)
    {
        if (isset($options['pattern'])) {
            $this->pattern = $options['pattern'];
        }
        if (isset($options['patterns'])) {
            $this->patterns = $options['patterns'];
        }

        return parent::setOptions($options);
    }

    protected function generateValue(CrawlerContainer $crawlerContainer)
    {
        $html = $crawlerContainer->getHtml();

        if ($this->patterns) {
            $patterns = $this->patterns;
        } else {
            $patterns = [];
            $patterns[] = $this->pattern;
        }

        foreach ($patterns as $pattern) {

            preg_match($pattern, $html, $matches);

            if (isset($matches[1])) {
                $this->value = $matches[1];
                return;
            }

        }
    }

}