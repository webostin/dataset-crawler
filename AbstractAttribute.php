<?php


namespace Webostin\Component\DatasetCrawler;


abstract class AbstractAttribute
{
    protected $name;
    protected $value;
    protected $options;
    /**
     * @var FormatterInterface
     */
    protected $formatter;

    protected abstract function generateValue(CrawlerContainer $crawlerContainer);

    public function createValue(CrawlerContainer $crawlerContainer)
    {
        $this->generateValue($crawlerContainer);

        if ($this->hasFormatter()) {
            $formatter = $this->getFormatter();
            $this->value = $formatter->format($this->value, $this->options);
        }

        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }


    public function getOptions()
    {
        return $this->options;
    }

    public function setOptions($options)
    {
        if (isset($options['formatter'])) {
            $this->formatter = $options['formatter'];
        }
        $this->options = $options;
        return $this;
    }

    public function hasFormatter()
    {
        if (!empty($this->formatter)) {
            if (class_exists($this->formatter)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return FormatterInterface
     */
    protected function getFormatter()
    {
        return new $this->formatter();
    }

}