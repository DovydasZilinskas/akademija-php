<?php

namespace App\Repository;

use App\Entity\EmailList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmailList|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmailList|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmailList[]    findAll()
 * @method EmailList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmailList::class);
    }

    // /**
    //  * @param string|null $term
    //  */
    
    // public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    // {
    //     return $this->createQueryBuilder('e')
    //         ->orderBy('e.id', 'ASC')
    //         ->setMaxResults(10)
    //     ;
    // }
    

    /*
    public function findOneBySomeField($value): ?EmailList
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
