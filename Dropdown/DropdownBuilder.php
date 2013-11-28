<?php

namespace KuSf2\Bundle\UtilsBundle\Dropdown;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of DropdownBuilder
 *
 * @author Manuel Aguirre <programador.manuel@gmail.com>
 */
abstract class DropdownBuilder implements DropdownBuilderInterface, ContainerAwareInterface
{

    /**
     *
     * @var ContainerInterface
     */
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function setDefaultsOptions(OptionsResolverInterface $resolver)
    {
        
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @param string         $route         The name of the route
     * @param mixed          $parameters    An array of parameters
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    protected function generateUrl($route, $parameters = array())
    {
        return $this->container->get('router')->generate($route, $parameters);
    }

}
