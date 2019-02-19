<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Symfony\Component\DomCrawler\Crawler;

class FilterHtmlType extends CrawlerFilterType
{
    protected function retrieveValue(Crawler $firstFoundNode)
    {
        return $firstFoundNode->html();
    }
}