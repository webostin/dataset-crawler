<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Symfony\Component\DomCrawler\Crawler;

class FilterAttrType extends CrawlerFilterType
{
    protected $attr;

    public function setOptions($options)
    {
        if (isset($options['filter_attr'])) {
            $this->attr = $options['filter_attr'];
        }
        return parent::setOptions($options);
    }

    protected function retrieveValue(Crawler $firstFoundNode)
    {
        return $firstFoundNode->attr($this->attr);
    }

}