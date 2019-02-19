<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class ContainsFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        if (isset($options['contains'])) {
            $containsTag = $options['contains'];
            if (is_array($containsTag)) {
                foreach ($containsTag as $key => $tag) {
                    if (strpos($value, $tag) !== false) {
                        return 1;
                    }
                }
            }
        }

        return 0;
    }
}