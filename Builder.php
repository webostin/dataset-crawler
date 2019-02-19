<?php


namespace Webostin\Component\DatasetCrawler;


use Doctrine\Common\Collections\ArrayCollection;

class Builder
{

    protected $attributes;

    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    public function add($field, $type, $options = [])
    {
        $attribute = new $type();
        if ($attribute instanceof AbstractAttribute) {
            $attribute->setName($field)
                ->setOptions($options);

            $this->attributes->add($attribute);
        }

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

}