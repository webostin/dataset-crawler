<?php


namespace Webostin\Component\DatasetCrawler\Provider;


use Webostin\Component\DatasetCrawler\HtmlProviderInterface;

class CurlProvider implements HtmlProviderInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function getHtml($url)
    {
        $curl = new \CurlHelper($url);
        $curl->follow(true);
        $response = $curl->exec();

        if ($response['status'] == 200) {
            return $response['content'];
        }

        return '';
    }

}