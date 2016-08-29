<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Album;
use AppBundle\Entity\Image;

class LoadGalleryData implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    for ( $i = 1; $i <= 5 ; $i++ ) { 
      $album = new Album;
      $album->setName(sprintf('Album %d', $i));

      $manager->persist($album);
      $manager->flush();

      $imagesCnt = ( 1 == $i )
        ? 5
        : rand(20, 30);

      for ( $j = 1; $j <= $imagesCnt ; $j++ ) { 
        $imageTitle = sprintf('Image %d of album %d', $j, $i);
        $src = sprintf('https://placekitten.com/%d/%d', rand(100, 200), rand(100, 200));

        $image = new Image;
        $image->setAlbum($album);
        $image->setSrc($src);
        $image->setTitle($imageTitle);
        
        $manager->persist($image);
      }

      $manager->flush();
    }

    
  }
}