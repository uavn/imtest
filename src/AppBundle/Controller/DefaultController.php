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
  public function homepageAction(Request $request)
  {
    $albums = $this->get('gallery')
      ->getAlbums(1/* page */, 1000 /* limit */);

    // print_r($albums);die;
    return [
      'albums' => $albums
    ];
  }

  /**
   * @Route("/album/{id}", name="album")
   * @Route("/album/{id}/page/{page}/", name="album-page", requirements={"page": "\d+"})
   * @Template()
   */
  public function albumAction(Request $request, $id, $page = 1)
  {
    $album = $this->get('gallery')
      ->getAlbum($id);

    $images = $this->get('gallery')
      ->getImages($id, $page);

    $images->setUsedRoute('album-page');

    return [
      'album' => $album,
      'images' => $images
    ];
  }
}
