<?php

namespace App\Repository;

use App\Entity\SchoolDuty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolDuty|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolDuty|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolDuty[]    findAll()
 * @method SchoolDuty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolDutyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolDuty::class);
    }

    // /**
    //  * @return SchoolDuty[] Returns an array of SchoolDuty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SchoolDuty
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
