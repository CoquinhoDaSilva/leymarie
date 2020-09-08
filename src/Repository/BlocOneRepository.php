<?php

namespace App\Repository;

use App\Entity\BlocOne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlocOne|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocOne|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocOne[]    findAll()
 * @method BlocOne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocOneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocOne::class);
    }

    // /**
    //  * @return BlocOne[] Returns an array of BlocOne objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlocOne
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
