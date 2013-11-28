<?php

namespace KuSf2\Bundle\UtilsBundle\Dropdown;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @author Manuel Aguirre <programador.manuel@gmail.com>
 */
interface DropdownBuilderInterface
{

    public function build(ItemContainer $container, $options = array());
    public function setDefaultsOptions(OptionsResolverInterface $resolver);
}
