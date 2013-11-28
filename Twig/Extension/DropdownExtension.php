<?php

namespace KuSf2\Bundle\UtilsBundle\Twig\Extension;

use KuSf2\Bundle\UtilsBundle\Dropdown\DropdownFactory;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of HtmlExtension
 *
 * @author PERSONAL
 */
class DropDownExtension extends Twig_Extension
{

    /**
     *
     * @var DropdownFactory
     */
    protected $dropdownFactory;

    function __construct(DropdownFactory $dropdownFactory)
    {
        $this->dropdownFactory = $dropdownFactory;
    }

    public function getName()
    {
        return 'kusf2_dropdown_extension';
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('dropdown', array($this, 'dropdown'), array('is_safe' => array('html'))),
            new Twig_SimpleFunction('dropdown_ddslick', array($this, 'js'), array('is_safe' => array('html'), 'needs_environment' => true)),
        );
    }

    public function dropdown($name, $options = array())
    {
        return $this->dropdownFactory->create($name, $options);
    }

    public function js(\Twig_Environment $twig)
    {
        $html = $twig->getExtension('kusf2_html_extension')->js('bundles/kusf2utils/js/jquery.ddslick.min.js');

        $html .= <<<HTML
<script>
$(".ku_dropdown").each(function(){
    $(this).ddslick({
        width: 120,
        onSelected: function(data, a) {
            var select = data.original;
            if(select.is('.initialize')){
                select.find(':selected').change();
            }else{
                select.addClass('initialize');
            }
        }
    });
});
</script>
HTML;

        return $html;
    }

}
