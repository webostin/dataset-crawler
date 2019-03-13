<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class StrreplaceFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        $search = $options['str_search'];
        $replace = $options['str_replace'];

        return str_replace($search, $replace, $value);
    }

}