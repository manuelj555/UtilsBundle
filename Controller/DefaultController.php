<?php

namespace KuSf2\Bundle\UtilsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('KuSf2UtilsBundle:Default:index.html.twig', array('name' => $name));
    }
}
