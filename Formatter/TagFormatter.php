<?php


namespace Webostin\Component\DatasetCrawler\Formatter;


use Webostin\Component\DatasetCrawler\FormatterInterface;

class TagFormatter implements FormatterInterface
{
    public function format($value, $options = [])
    {
        $tags = explode(',', $value);
        if (isset($options['forbidden_tags'])) {
            $forbiddenTags = $options['forbidden_tags'];
            if (is_array($forbiddenTags)) {
                foreach ($tags as $key => $tag) {
                    if (in_array($tag, $forbiddenTags)) {
                        unset($tags[$key]);
                    }
                }
            }
        }

        return $tags;
    }

}