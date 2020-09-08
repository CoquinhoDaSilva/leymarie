<?php

namespace App\Repository;

use App\Entity\BlocTwo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BlocTwo|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlocTwo|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlocTwo[]    findAll()
 * @method BlocTwo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlocTwoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlocTwo::class);
    }

    // /**
    //  * @return BlocTwo[] Returns an array of BlocTwo objects
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
    public function findOneBySomeField($value): ?BlocTwo
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
