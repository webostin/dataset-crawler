<?php


namespace Webostin\Component\DatasetCrawler;


abstract class AbstractCrawler
{
    protected $url;

    abstract protected function buildAttributes(Builder $builder);

    public function createDataset(string $url, $options = []): array
    {
        $dataset = [];
        $html = $this->get($url);

        $crawlerContainer = new CrawlerContainer($url, $html, $options);

        $builder = new Builder();

        $this->buildAttributes($builder);

        $attributes = $builder->getAttributes();

        foreach ($attributes as $attribute) {
            if ($attribute instanceof AbstractAttribute) {
                $attribute->createValue($crawlerContainer);
                $dataset[$attribute->getName()] = $attribute->getValue();
                $crawlerContainer->setOption('dataset', $dataset);
            }
        }

        return $dataset;
    }


    protected function get(string $url): string
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