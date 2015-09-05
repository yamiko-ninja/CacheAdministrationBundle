<?php

namespace Yamiko\CacheAdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Default controller.
 *
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * index action.
     *
     * @param string $name name of person to say hello to
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($name)
    {
        return $this->render('YamikoCacheAdministrationBundle:Default:index.html.twig', array('name' => $name));
    }
}
