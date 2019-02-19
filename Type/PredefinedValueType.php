<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;

class PredefinedValueType extends AbstractAttribute
{
    public function setOptions($options)
    {
        if (isset($options['default_value'])) {
            $this->value = $options['default_value'];
        }
        return parent::setOptions($options);
    }


    protected function generateValue(CrawlerContainer $crawlerContainer)
    {
        $defaultOptions = $crawlerContainer->getOptions();
        if (is_array($defaultOptions) AND isset($this->options['default_option'])) {
            if (isset($defaultOptions[$this->options['default_option']])) {
                return $defaultOptions[$this->options['default_option']];
            }
        }
        return $this->value;
    }

}