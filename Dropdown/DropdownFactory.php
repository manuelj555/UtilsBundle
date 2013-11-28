<?php

namespace KuSf2\Bundle\UtilsBundle\Dropdown;

use InvalidArgumentException;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig_Environment;

/**
 * Description of DropdownFactory
 *
 * @author Manuel Aguirre <programador.manuel@gmail.com>
 */
class DropdownFactory
{

    /**
     *
     * @var Twig_Environment
     */
    protected $twig;

    /**
     *
     * @var KernelInterface
     */
    protected $kernel;

    /**
     *
     * @var ContainerInterface
     */
    protected $container;
    protected $builders = array();

    public function __construct(Twig_Environment $twig, KernelInterface $kernel, ContainerInterface $container)
    {
        $this->twig = $twig;
        $this->kernel = $kernel;
        $this->container = $container;
    }

    public function create($name, $options = array())
    {
        if (!$this->isValidName($name)) {
            throw new InvalidArgumentException(sprintf('Invalid pattern passed to builder - expected "bundle:class", got "%s".', $name));
        }

        list($bundleName, $className) = explode(':', $name);

        $builder = $this->getBuilder($bundleName, $className);

        $dropdown = $this->build($builder, $options);
        
        $id = uniqid("dropdown_");

        $options = $this->twig->render("KuSf2UtilsBundle:dropdown:dropdown.html.twig", array(
            'items' => $dropdown->getItems(),
            'id' => $id,
        ));

        return $options;
    }

    /**
     * 
     * @param DropdownBuilderInterface $builder
     * @param array $options
     * @return ItemContainer
     */
    public function build(DropdownBuilderInterface $builder, $options = array())
    {
        $resolver = new OptionsResolver();
        $builder->setDefaultsOptions($resolver);

        $builder->build($dropdown = new ItemContainer(), $resolver->resolve($options));

        return $dropdown;
    }

    protected function isValidName($name)
    {
        return 1 == substr_count($name, ':');
    }

    protected function getBuilder($bundleName, $className)
    {
        $name = sprintf('%s:%s', $bundleName, $className);

        if (!isset($this->builders[$name])) {
            $class = null;
            $logs = array();
            $bundles = array();

            foreach ($this->kernel->getBundle($bundleName, false) as $bundle) {
                $try = $bundle->getNamespace() . '\\Dropdown\\' . $className;
                if (class_exists($try)) {
                    $class = $try;
                    break;
                }

                $logs[] = sprintf('Class "%s" does not exist for Dropdown builder "%s".', $try, $name);
                $bundles[] = $bundle->getName();
            }

            if (null === $class) {
                if (1 === count($logs)) {
                    throw new InvalidArgumentException($logs[0]);
                }

                throw new InvalidArgumentException(sprintf('Unable to find Dropdown builder "%s" in bundles %s.', $name, implode(', ', $bundles)));
            }

            $builder = new $class();

            if ($builder instanceof ContainerAwareInterface) {
                $builder->setContainer($this->container);
            }

            if (!$builder instanceof DropdownBuilderInterface) {
                throw new InvalidArgumentException(sprintf('La clase %s debe implementar DropdownBuilderInterface', $className, $name));
            }

            $this->builders[$name] = $builder;
        }

        return $this->builders[$name];
    }

}
