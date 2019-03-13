<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class StrreplaceFormatter extends TrimFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        $search = $options['str_search'];
        $replace = $options['str_replace'];

        $value = str_replace($search, $replace, $value);

        if (isset($options['trim'])) {
            return parent::format($value, $options);
        }

        return $value;
    }

}