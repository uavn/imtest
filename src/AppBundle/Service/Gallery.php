<?php
namespace AppBundle\Service;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;
use Knp\Component\Pager\Paginator;

class Gallery {
  private $doctrine;
  private $paginator;

  public function __construct( Doctrine $doctrine, Paginator $paginator ) {
    $this->doctrine = $doctrine;
    $this->paginator = $paginator;
  }

  public function getAlbums($page = 1, $ipp = 10) {
    $em = $this->doctrine->getEntityManager();
    
    $query = $em->createQueryBuilder()
      ->select('a')
      ->from('AppBundle:Album', 'a')
      ->orderBy('a.id', 'DESC')
      ;

    $pagination = $this->paginator->paginate(
      $query, $page, $ipp
    );

    return $pagination;
  }

  public function getAlbum($id) {
    $album = $this->doctrine
      ->getRepository('AppBundle:Album')
      ->find($id)
      ;

    return $album;
  }

  public function getImages($albumId, $page = 1, $ipp = 10) {
    $em = $this->doctrine->getEntityManager();
    
    $query = $em->createQueryBuilder()
      ->select('i')
      ->from('AppBundle:Image', 'i')
      ->where('i.album = :album')
      ->setParameter('album', $em->getReference('AppBundle:Album', $albumId))
      ->orderBy('i.id', 'ASC')
      ;

    $pagination = $this->paginator->paginate(
      $query, $page, $ipp
    );

    return $pagination;
  }
}