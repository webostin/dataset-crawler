<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


class StrtolowerFormatter extends TrimFormatter
{
    public function format($value, $options = [])
    {
        if (isset($options['trim'])) {
            $value = parent::format($value, $options);
        }

        return mb_strtolower($value);
    }

}