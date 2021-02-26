<?php

namespace App\Repository;

use App\Entity\EmailList;
use DateTime;
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
    
    public function getWithSearchQueryBuilder(): string
    {
        return $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function getSearchName($name, $orderBy, $order)
    {
        $qp = $this->createQueryBuilder('a')
            ->select('a')
            ->where("a.name LIKE '%$name%'");
        if ($orderBy == 'name') {
            return $qp->orderBy('a.name', $order)->getQuery();
        } elseif ($orderBy == 'email') {
            return $qp->orderBy('a.email', $order)->getQuery();
        } elseif ($orderBy == 'message') {
            return $qp->orderBy('a.message', $order)->getQuery();
        } else {
            return $qp->orderBy('a.createdAt', $order)->getQuery();
        }
    }

    public function getSearchMessage($message, $orderBy, $order)
    {
        $qp = $this->createQueryBuilder('a')
            ->select('a')
            ->where("a.message LIKE '%$message%'")
            ->orderBy("a.'%$orderBy%'", "'%$order%'");
        if ($orderBy == 'name') {
            return $qp->orderBy('a.name', $order)->getQuery();
        } elseif ($orderBy == 'email') {
            return $qp->orderBy('a.email', $order)->getQuery();
        } elseif ($orderBy == 'message') {
            return $qp->orderBy('a.message', $order)->getQuery();
        } else {
            return $qp->orderBy('a.createdAt', $order)->getQuery();
        }
    }

    public function getSearchEmail($email, $orderBy, $order)
    {
        $qp = $this->createQueryBuilder('a')
            ->select('a')
            ->where("a.email LIKE '%$email%'")
            ->orderBy("a.'%$orderBy%'", "'%$order%'");
        if ($orderBy == 'name') {
            return $qp->orderBy('a.name', $order)->getQuery();
        } elseif ($orderBy == 'email') {
            return $qp->orderBy('a.email', $order)->getQuery();
        } elseif ($orderBy == 'message') {
            return $qp->orderBy('a.message', $order)->getQuery();
        } else {
            return $qp->orderBy('a.createdAt', $order)->getQuery();
        }
    }

    public function getAllFiltered($orderBy, $order)
    {
        $qp = $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy("a.'%$orderBy%'", "'%$order%'");
        if ($orderBy == 'name') {
            return $qp->orderBy('a.name', $order)->getQuery();
        } elseif ($orderBy == 'email') {
            return $qp->orderBy('a.email', $order)->getQuery();
        } elseif ($orderBy == 'message') {
            return $qp->orderBy('a.message', $order)->getQuery();
        } else {
            return $qp->orderBy('a.createdAt', $order)->getQuery();
        }
    }

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
