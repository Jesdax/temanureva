<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 08/08/18
 * Time: 22:33
 */

namespace App\Service;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ArticleManager
{
    private $entityManager;
    private $fileManager;
    private $imageDirectory;

    public function __construct(EntityManagerInterface $entityManager, FileManager $fileManager, $directory)
    {
        $this->entityManager = $entityManager;
        $this->fileManager = $fileManager;
        $this->imageDirectory = $directory;
    }

    /**
     * @return Article
     */
    public function getDefaultArticle(){
        $article = new Article();
        $article
            ->setTitle('Votre Titre')
            ->setContent('Votre article')
            ->setStatus('false')
            ->setImage(null)
            ->setModificationDate(new \DateTime())
            ->setPublishingDate(null)
            ->setUser(null);

        return $article;
    }

    public function deleteArticle(Article $article){
        $this->entityManager->remove($article);
    }

    public  function saveArticle(Article $article){
        $article->setModificationDate(new \DateTime());
        $this->entityManager->flush();
    }

    public  function publishArticle(Article $article){
        $article
            ->setPublishingDate(new \DateTime())
            ->setModificationDate(new \DateTime())
            ->setStatus(true);
        $this->entityManager->flush();
    }

    public function uploadImage(Article $article, UploadedFile $file){
        $fileName = $this->fileManager->upload($file, $this->imageDirectory);
        $article->setImage($fileName);
    }
}