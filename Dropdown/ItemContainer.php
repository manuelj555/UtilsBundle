<?php

namespace KuSf2\Bundle\UtilsBundle\Dropdown;

use Doctrine\Common\Collections\ArrayCollection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemContainer
 *
 * @author Manuel Aguirre <programador.manuel@gmail.com>
 */
class ItemContainer
{

    /**
     *
     * @var ArrayCollection
     */
    protected $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function add($text)
    {
        $item = new Item($text);

        $this->items->set($text, $item);

        return $item;
    }

    public function getItems()
    {
        return $this->items;
    }

//    public function getArrayItems()
//    {
//        $array = array();
//        
//        foreach($this->getItems() as $text => $item){
//            $array[] = array(
//                'text' => $item->getText(),
//                'imageSrc' => $item->getImage(),
//            );
//        }
//    }

}
