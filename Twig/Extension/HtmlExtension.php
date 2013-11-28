<?php

namespace KuSf2\Bundle\UtilsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of HtmlExtension
 *
 * @author PERSONAL
 */
class HtmlExtension extends Twig_Extension
{

    /**
     *
     * @var ContainerInterface
     */
    protected $container;
    
    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

        public function getName()
    {
        return 'kusf2_html_extension';
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('js', array($this, 'js'), array('is_safe' => array('html'))),
            new Twig_SimpleFunction('css', array($this, 'css'), array('is_safe' => array('html'))),
        );
    }

    public function js($js)
    {
        return '<script type="text/javascript" src="' . $this->asset($js) . '"></script>';
    }

    public function css($css, $media = 'screen')
    {
        return '<link href="' . $this->asset($css) . '" media="' . $media . '" rel="stylesheet" />';
    }

    protected function asset($path)
    {
        return $this->container->get('templating.helper.assets')->getUrl($path);
    }

}
