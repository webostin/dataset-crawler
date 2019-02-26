<?php


namespace Webostin\Component\DatasetCrawler\Type;


use Webostin\Component\DatasetCrawler\AbstractAttribute;
use Webostin\Component\DatasetCrawler\CrawlerContainer;

class FirstInQueueType extends AbstractAttribute
{

    protected $attributes;

    public function setOptions($options)
    {

        if (isset($options['queue'])) {
            $this->attributes = $options['queue'];
        }

        return parent::setOptions($options);
    }


    protected function generateValue(CrawlerContainer $crawlerContainer)
    {
        if (!empty($this->attributes)) {
            foreach ($this->attributes as $attribute) {
                $attributeClass = $attribute['class'];
                $attributeInstance = new $attributeClass();
                if ($attributeInstance instanceof AbstractAttribute) {
                    $attributeInstance
                        ->setName($this->name);

                    if (isset($attribute['options'])) {
                        $attributeInstance
                            ->setOptions($attribute['options']);
                    }

                    $attributeInstance->createValue($crawlerContainer);
                    $value = $attributeInstance->getValue();

                    if (!empty($value)) {
                        return $this->value = $value;
                    }
                }
            }
        }

        return '';
    }

}