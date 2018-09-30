<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findById($id){
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $qb->getOneOrNullResult();
    }

    public function findByEmail($email){
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery();

        return $qb->getOneOrNullResult();
    }

    public function findByEmailAndToken($email, $token){
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.email = :email')
            ->andWhere('u.token = :token')
            ->setParameter('email', $email)
            ->setParameter('token', $token)
            ->getQuery();

        return $qb->getOneOrNullResult();
    }

    public function findByIdWithPassword($id, $password){
        $qd = $this->createQueryBuilder('u')
            ->andWhere('u.id = :id')
            ->andWhere('u.password = :password')
            ->setParameter('id', $id)
            ->setParameter('password', $password)
            ->getQuery();

        return $qd->getOneOrNullResult();
    }

    public function getNumberUser(){
        $qb = $this->createQueryBuilder('u');
        $qb->select($qb->expr()->count('u.id'));

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findWithOffset(int $offset, int $limit)
    {
        $qb = $this->createQueryBuilder('u')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('u.registration_date', 'DESC')
            ->getQuery();

        return $qb->getResult();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
