<?php

namespace KuSf2\Bundle\UtilsBundle\Dropdown;

use KuSf2\Bundle\UtilsBundle\Dropdown\DropdownBuilder;
use KuSf2\Bundle\UtilsBundle\Dropdown\ItemContainer;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DropdownTest
 *
 * @author Manuel Aguirre <programador.manuel@gmail.com>
 */
class DropdownTest extends DropdownBuilder
{

    public function build(ItemContainer $container, $options = array())
    {
        $container->add('Redirect')->setHref('mmm');
        $container->add('alert')->setOnClick('alert("Hola Manuel")');
    }

}
