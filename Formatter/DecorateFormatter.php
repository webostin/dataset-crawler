<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class DecorateFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        $prepend = '';
        $append = '';

        if (isset($options['decorate_before'])) {
            $prepend = $options['decorate_before'];
        }
        if (isset($options['decorate_after'])) {
            $append = $options['decorate_after'];
        }

        if (is_array($value)) {
            $value = $this->decorateMany($value, $prepend, $append);
        } else {
            $value = $this->decorate($value, $prepend, $append);
        }

        return $value;
    }

    protected function decorateMany($values, $prepend = '', $append = '')
    {
        foreach ($values as &$value) {
            $value = $this->decorate($value, $prepend, $append);
        }

        return $values;
    }

    protected function decorate($value, $prepend = '', $append = '')
    {
        $value = $prepend . $value;
        $value .= $append;

        return $value;
    }

}