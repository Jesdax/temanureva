<?php

namespace App\Repository;

use App\Entity\Observation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Observation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Observation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Observation[]    findAll()
 * @method Observation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObservationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Observation::class);
    }

    public function findById($id){
        $qb = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        return $qb->getSingleResult();
    }


    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function countById($id){
        $qb = $this->createQueryBuilder('o')
            ->innerJoin('o.bird', 'b')
            ->where('b.id = :id')
            ->setParameter('id', $id);
        $qb->select($qb->expr()->count('o.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getNumberObservationsByUserId($id){
        $qb = $this->createQueryBuilder('o')
            ->where('o.observer = :id')
            ->setParameter('id', $id);
        $qb->select($qb->expr()->count('o.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findAllByUserId($id, $offset, $limit){
        return $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->where('o.observer = :id')
            ->setParameter('id', $id)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    public function findObservationByBirdId($id){
       return $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->where('o.bird = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();

    }
//    /**
//     * @return Observation[] Returns an array of Observation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Observation
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
