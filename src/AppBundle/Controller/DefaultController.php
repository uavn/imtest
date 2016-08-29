<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
  /**
   * @Route("/", name="homepage")
   * @Template()
   */
  public function indexAction(Request $request)
  {
    
    return [];
  }

  /**
   * @Route("/album/{id}", name="album")
   * @Route("/album/{id}/page/{page}", name="album-page")
   * @Template()
   */
  public function albumAction(Request $request, $id, $page = 1)
  {
    return [];
  }
}
