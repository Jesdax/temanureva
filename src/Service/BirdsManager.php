<?php
/**
 * Created by PhpStorm.
 * User: rozenn
 * Date: 22/08/18
 * Time: 16:05
 */

namespace App\Service;

use App\Entity\Bird;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BirdsManager
{

    private $entityManager;
    private $fileManager;
    private $storage;
    private $imageDirectory;

    public function __construct(EntityManagerInterface $entityManager, FileManager $fileManager, TokenStorageInterface $storage , $directory)
    {
        $this->entityManager = $entityManager;
        $this->fileManager = $fileManager;
        $this->imageDirectory = $directory;
        $this->storage = $storage;
    }

    public function birdUploadImage(Bird $bird, UploadedFile $file){
        $fileName = $this->fileManager->upload($file, $this->imageDirectory);
        $bird->setImage($fileName);
        $this->entityManager->flush();
    }

    public function birdDeleteImage(Bird $bird){
        $this->fileManager->delete($this->imageDirectory.'/'.$bird->getImage());
        $bird->setImage(null); //souci avec cette ligne TODO
        $this->entityManager->flush(); // image non supprimée de la bdd mais uniquement dossier img/birds
    }

}