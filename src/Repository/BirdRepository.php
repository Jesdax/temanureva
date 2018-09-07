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
        $qb ->select('b.vernacularName', 'b.id', 'b.nameOrder', 'b.family') //'b.nameOrder' pour afficher le champ
            ->where('b.vernacularName LIKE :term' || 'b.nameOrder LIKE :term' || 'b.family LIKE :term') // ou bien machin, ou bien truc, ou bien bidule
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

    public function findByVernacularName($offset, $limit)
    {
        return $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('b.vernacularName', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    public function findByDescVernacularName($offset, $limit)
    {
        return $qb = $this->createQueryBuilder('b')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('b.vernacularName', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function countByID($id){
        $qb = $this->createQueryBuilder('o')
            ->innerJoin('o.bird', 'b')
            ->where('b.id = :id')
            ->setParameter('id', $id);

        $qb->select($qb->expr()->count('o.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findByNbObservation($offset, $limit)
    {
       /* $qb = $this->createQueryBuilder('b')
            ->innerJoin('b.observations', 'o')
            ->select('b')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('o.vernacularName', 'ASC')

          $qb->getQuery()->getResult();*/
    }

    public function findByDescNbObservation($offset, $limit)
    {

    }

    public function getNumberBirds(){
        $qb = $this->createQueryBuilder('b');
        $qb->select($qb->expr()->count('b.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }
}

