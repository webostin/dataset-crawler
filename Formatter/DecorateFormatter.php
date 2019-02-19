<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class DecorateFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        if (isset($options['decorate_before'])) {
            $value = $options['decorate_before'] . $value;
        }
        if (isset($options['decorate_after'])) {
            $value .= $value . $options['decorate_after'];
        }

        return $value;
    }

}