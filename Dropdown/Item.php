<?php

namespace KuSf2\Bundle\UtilsBundle\Dropdown;

/**
 * Description of Item
 *
 * @author Manuel Aguirre <programador.manuel@gmail.com>
 */
class Item
{

    protected $text;
    protected $description;
    protected $image;
    protected $href;
    protected $onClick;
    
        public function __construct($text = null)
    {
        $this->text = $text;
    }

        public function getText()
    {
        return $this->text;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getHref()
    {
        return $this->href;
    }

    public function getOnClick()
    {
        return $this->onClick;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    public function setOnClick($onClick)
    {
        $this->onClick = $onClick;
        return $this;
    }

    public function hasHref()
    {
        return $this->getHref() !== null;
    }

    public function hasOnClick()
    {
        return $this->getOnClick() !== null;
    }

}
