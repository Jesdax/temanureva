<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 05/09/18
 * Time: 10:01
 */

namespace App\Service;


use App\Entity\Observation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ObsrevationManager
{
    private $entityManager;
    private $fileManager;
    private $storage;
    private $imageDirectory;

    public function __construct(EntityManagerInterface $entityManager, FileManager $fileManager, TokenStorageInterface $storage)
    {
        $this->entityManager = $entityManager;
        $this->fileManager = $fileManager;
        $this->storage = $storage;
    }

    public function valide(Observation $observation){
        $observation
            ->setValidationDate(new \DateTime())
            ->setValidator($this->storage->getToken()->getUser());
//        $this->entityManager->flush();
    }
}