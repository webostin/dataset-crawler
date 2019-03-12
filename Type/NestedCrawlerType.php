<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Symfony\Component\DomCrawler\Crawler;
use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;

class NestedCrawlerType extends AbstractAttribute
{
    protected $filter = 'meta[name="description"]';
    protected $attributes = [];
    protected $types = [];

    public function setOptions($options)
    {
        if (isset($options['filter'])) {
            $this->filter = $options['filter'];
        }
        if (isset($options['attributes'])) {
            $this->attributes = $options['attributes'];
            $this->buildAttributes();
        }

        return parent::setOptions($options);
    }

    protected function generateValue(CrawlerContainer $crawlerContainer)
    {

        $crawler = $crawlerContainer->getCrawler();
        $values = [];

        $crawler->filter($this->filter)->each(function (Crawler $crawler) use (&$values) {
            $values[] = $this->retrieveValue($crawler);
        });

        $this->value = $values;

    }

    protected function retrieveValue(Crawler $crawler): array
    {
        $crawlerContainer = new CrawlerContainer('', '');
        $crawlerContainer->setCrawler($crawler);

        $value = [];
        foreach ($this->types as $type) {
            if ($type instanceof AbstractAttribute) {
                $type->createValue($crawlerContainer);
                $value[$type->name] = $type->getValue();
            }
        }

        return $value;
    }

    protected function buildAttributes()
    {
        if (is_array($this->attributes)) {
            foreach ($this->attributes as $attribute) {
                $attributeClass = $attribute['class'];
                $attributeInstance = new $attributeClass();

                if ($attributeInstance instanceof AbstractAttribute) {

                    $attributeInstance->name = $attribute['name'];
                    $attributeInstance->setOptions($attribute['options']);

                    $this->types[] = $attributeInstance;
                }
            }
        }
    }
}