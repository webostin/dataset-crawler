<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;
use Symfony\Component\DomCrawler\Crawler;

abstract class CrawlerFilterType extends AbstractAttribute
{
    protected $filter = 'meta[name="description"]';
    protected $multiple = false;

    abstract protected function retrieveValue(Crawler $firstFoundNode);

    public function setOptions($options)
    {
        if (isset($options['filter'])) {
            $this->filter = $options['filter'];
        }
        if (isset($options['multiple'])) {
            $this->multiple = (bool)$options['multiple'];
        }

        return parent::setOptions($options);
    }

    protected function generateValue(CrawlerContainer $crawlerContainer)
    {
        $crawler = $crawlerContainer->getCrawler();

        if ($this->multiple) {
            $crawler = $crawlerContainer->getCrawler();
            $values = [];

            $crawler->filter($this->filter)->each(function (Crawler $crawler) use (&$values) {
                $values[] = $this->retrieveValue($crawler);
            });

            $this->value = $values;
        } else {
            $firstNode = $crawler->filter($this->filter)->first();
            if ($firstNode instanceof Crawler) {
                $this->value = $this->retrieveValue($firstNode);
            }
        }
    }

}