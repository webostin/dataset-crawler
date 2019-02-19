<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class PregMatchFormatter implements FormatterInterface
{
    protected $pattern = '';
    protected $patterns = [];

    public function format($value, $options = [])
    {
        $this->setOptions($options);

        if ($this->patterns) {
            $patterns = $this->patterns;
        } else {
            $patterns = [];
            $patterns[] = $this->pattern;
        }

        foreach ($patterns as $pattern) {


            preg_match($pattern, $value, $matches);

            if (isset($matches[1])) {
                return $matches[1];
            }

        }

        return '';
    }

    public function setOptions($options)
    {
        if (isset($options['pattern'])) {
            $this->pattern = $options['pattern'];
        }
        if (isset($options['patterns'])) {
            $this->patterns = $options['patterns'];
        }
    }


}