<?php


namespace Webostin\Component\DatasetCrawler\Type;


class MetaType extends FilterAttrType
{
    protected $attr = 'content';

    public function setOptions($options)
    {
        if (isset($options['meta_name'])) {
            $this->filter = 'meta[name="' . $options['meta_name'] . '"]';
        }
        if (isset($options['meta_property'])) {
            $this->filter = 'meta[property="' . $options['meta_property'] . '"]';
        }
        parent::setOptions($options);
    }
}