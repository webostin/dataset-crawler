<?php


namespace Webostin\Component\DatasetCrawler;


interface FormatterInterface
{
    public function format($value, $options = []);
}