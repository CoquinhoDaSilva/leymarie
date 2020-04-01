<?php

namespace App\Repository;

use App\Entity\Healthcare;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Healthcare|null find($id, $lockMode = null, $lockVersion = null)
 * @method Healthcare|null findOneBy(array $criteria, array $orderBy = null)
 * @method Healthcare[]    findAll()
 * @method Healthcare[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HealthcareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Healthcare::class);
    }

    // /**
    //  * @return Healthcare[] Returns an array of Healthcare objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Healthcare
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
