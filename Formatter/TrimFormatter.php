<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class TrimFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        if (isset($options['trim_char_list'])) {
            return trim($value, $options['trim_char_list']);
        }
        return trim($value);
    }

}