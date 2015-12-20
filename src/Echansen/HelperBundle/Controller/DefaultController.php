<?php

namespace Echansen\HelperBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HelperBundle:Default:index.html.twig');
    }
}
