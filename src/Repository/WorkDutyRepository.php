<?php

namespace App\Repository;

use App\Entity\WorkDuty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkDuty|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkDuty|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkDuty[]    findAll()
 * @method WorkDuty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkDutyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkDuty::class);
    }

    // /**
    //  * @return WorkDuty[] Returns an array of WorkDuty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkDuty
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
