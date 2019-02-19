<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;

class CheckDatasetValueType extends AbstractAttribute
{
    protected $datasetMatch;
    protected $datasetKey;
    protected $defaultValue;

    public function setOptions($options)
    {
        if (isset($options['default_value'])) {
            $this->value = $options['default_value'];
        }
        if (isset($options['dataset_key'])) {
            $this->datasetKey = $options['dataset_key'];
        }
        if (isset($options['dataset_match'])) {
            $this->datasetMatch = $options['dataset_match'];
        }
        return parent::setOptions($options);
    }


    protected function generateValue(CrawlerContainer $crawlerContainer)
    {
        if ($this->datasetKey) {
            $options = $crawlerContainer->getOptions();
            if (is_array($options)) {
                if (isset($options['dataset'])) {
                    $dataset = $options['dataset'];
                    if (isset($dataset[$this->datasetKey])) {
                        $datasetKey = $dataset[$this->datasetKey];
                    }
                }
            }
        }

        if ($this->datasetMatch) {
            if (isset($datasetKey)) {
                foreach ($this->datasetMatch as $value => $contains) {
                    if (strpos($datasetKey, $contains) !== false) {
                        return $this->value = $value;
                    }
                }
            }
        }

        return $this->value;
    }

}