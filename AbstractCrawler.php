<?php


namespace Webostin\Component\DatasetCrawler;


use Webostin\Component\DatasetCrawler\Provider\CurlProvider;

abstract class AbstractCrawler
{
    /**
     * @var HtmlProviderInterface
     */
    protected $htmlProvider;
    /**
     * @var string
     */
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

    /**
     * @param string $url
     * @return string
     */
    protected function get(string $url): string
    {
        // setting curl as default
        if (!($this->htmlProvider instanceof HtmlProviderInterface)) {
            $this->htmlProvider = new CurlProvider();
        }
        return $this->htmlProvider->getHtml($url);
    }

    public function setHtmlProvider(HtmlProviderInterface $htmlProvider)
    {
        $this->htmlProvider = $htmlProvider;
        return $this;
    }

}