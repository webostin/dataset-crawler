<?php


namespace Webostin\Component\DatasetCrawler;


interface HtmlProviderInterface
{
    /**
     * @param string $url
     * @return string $html
     */
    public function getHtml($url);
}