<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;

class BaseUrlType extends AbstractAttribute
{
    protected function generateValue(CrawlerContainer $crawlerContainer)
    {
        return $this->value = $crawlerContainer->getUrl();
    }

}