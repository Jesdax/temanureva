<?php
/**
 * Created by PhpStorm.
 * User: rozenn
 * Date: 20/08/18
 * Time: 15:03
 */

namespace App\Service;

use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class ObservationManager
{
    private $entityManager;
    private $fileManager;
    private $storage;
    private $imageDirectory;

    public function __construct(EntityManagerInterface $entityManager, FileManager $fileManager, TokenStorageInterface $storage ,$directory)
    {
        $this->entityManager = $entityManager;
        $this->fileManager = $fileManager;
        $this->imageDirectory = $directory;
        $this->storage = $storage;
    }


    public function observationUpLoadImage(Observation $observation, UploadedFile $file){
        $fileName = $this->fileManager->upload($file, $this->imageDirectory);
        $observation->setImage($fileName);
    }

    public function valide(Observation $observation){
        $observation
            ->setStatus(true)
            ->setValidationDate(new \DateTime())
            ->setValidator($this->storage->getToken()->getUser());
        $this->entityManager->flush();
    }

    public function delete(Observation $observation){
        $this->deleteImage($observation);
        $this->entityManager->remove($observation);
        $this->entityManager->flush();
    }

    public function deleteImage(Observation $observation){
        $this->fileManager->delete($this->imageDirectory.'/'.$observation->getImage());
        $observation->setImage(null);
    }
}