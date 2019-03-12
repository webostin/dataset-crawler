<?php


namespace Webostin\Component\DatasetCrawler\Provider;


use Webostin\Component\DatasetCrawler\HtmlProviderInterface;

class FilegetcontentsProvider implements HtmlProviderInterface
{
    public function getHtml($url)
    {
        return file_get_contents($url);
    }

}