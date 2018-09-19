<?php

namespace App\Repository;

use App\Entity\Bird;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bird|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bird|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bird[]    findAll()
 * @method Bird[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BirdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bird::class);
    }

    public function findBirdById($id)
    {
        $qb = $this->createQueryBuilder('b')
            ->andWhere('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->getSingleResult();
    }
    /**
     * @return Bird[] Returns an array of Bird objects for autocomplete
     */
    public function findAllByVernacularName($term)
    {
        $qb = $this->createQueryBuilder('b');
        $qb ->select('b.vernacularName', 'b.id') //'b.nameOrder' pour afficher le champ
            ->where('b.vernacularName LIKE :term') // ou bien machin, ou bien truc, ou bien bidule
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('b.vernacularName', 'ASC');
        $birds = $qb->getQuery()
            ->getResult();
        $result = [];
        foreach ($birds as $bird) {
            $res['id'] = $bird['id'];
            $res['name'] = $bird['vernacularName'];
            //$res['image'] = $bird['image'];
            $result[] = $res;
        }

        return $result;
    }

    public function findAllByMultipleCriteria($term){
        $qb = $this->createQueryBuilder('b');
        $qb ->select('b.vernacularName', 'b.id', 'b.nameOrder', 'b.family')
            ->where('b.vernacularName LIKE :term')
            ->orWhere('b.nameOrder LIKE :term')
            ->orWhere('b.family LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('b.vernacularName', 'ASC');
        $birds = $qb->getQuery()
            ->getResult();
        $result = [];
        foreach ($birds as $bird) {
            $res['id'] = $bird['id'];
            $res['name'] = $bird['vernacularName'];
            $res['order'] = $bird['nameOrder'];
            $res['family'] = $bird['family'];
            //$res['image'] = $bird['image'];
            $result[] = $res;
        }

        return $result;
    }

    public function findFamilyList($term)
    {
        $qb = $this->createQueryBuilder('b')
            ->where('b.family LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->distinct(true);
        $families = $qb->getQuery()
                ->getResult();

        return $families;
    }

    public function findByVernacularName($offset, $limit, $sorting)
    {
        return $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('b.vernacularName', $sorting)
            ->getQuery()
            ->getArrayResult();
    }

    public function findByFamily($offset, $limit, $sorting, $family)
    {
        return $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->where('b.family = :family')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameter('family', $family)
            ->orderBy('b.vernacularName', $sorting)
            ->getQuery()
            ->getArrayResult();
    }
    /*public function findByDescVernacularName($offset, $limit, $sorting)
    {
        return $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('b.vernacularName', $sorting)
            ->getQuery()
            ->getResult();
    }*/

    /*public function countByID($id){
        $qb = $this->createQueryBuilder('o')
            ->innerJoin('o.bird', 'b')
            ->where('b.id = :id')
            ->setParameter('id', $id);

        $qb->select($qb->expr()->count('o.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }*/

    public function findByNbObservation($offset, $limit, $sorting)
    {
       $qb = $this->createQueryBuilder('b')
            ->innerJoin('b.observations', 'o')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy(count('o.bird'), $sorting);

         return $qb->getQuery()->getResult();
    }

    /*public function findByDescNbObservation($offset, $limit)
    {
        $qb = $this->createQueryBuilder('b')
            ->innerJoin('b.observations', 'o')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy(count('o.bird'), 'DESC');

        return $qb->getQuery()->getResult();
    }*/

    public function getNumberBirds(){
        $qb = $this->createQueryBuilder('b');
        $qb->select($qb->expr()->count('b.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }
}

