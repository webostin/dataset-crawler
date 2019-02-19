<?php


namespace Webostin\Component\DatasetCrawler;


use Symfony\Component\DomCrawler\Crawler;

class CrawlerContainer
{
    protected $crawler;
    protected $html;
    protected $url;
    protected $options;

    public function __construct(string $url, string $html, $options = [])
    {
        $this->url = $url;
        $this->html = $html;
        $this->crawler = new Crawler($html);
        $this->options = $options;
    }

    public function getCrawler(): Crawler
    {
        return $this->crawler;
    }

    public function setCrawler(Crawler $crawler)
    {
        $this->crawler = $crawler;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }
}