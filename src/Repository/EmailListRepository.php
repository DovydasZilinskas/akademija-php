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

    public function getSearchValues(array $search, $orderBy, $order)
    {
        $qp = $this->createQueryBuilder('a');
        foreach ($search as $field => $value) {
            switch ($field) {
                case 'name':
                    $qp->andWhere("a.name LIKE '%$value%'");
                    break;
                case 'email':
                    $qp->andWhere("a.email LIKE '%$value%'");
                    break;
                case 'message':
                    $qp->andWhere("a.message LIKE '%$value%'");
                    break;
                case 'datefrom':
                    $qp->andWhere("a.createdAt >= '$value'");
                    break;
                case 'dateto':
                    $default = $value == "" ? "now" : $value;
                    $qp->andWhere("a.createdAt <= '$default'");
                    break;
            }
        }
        return $qp
            ->orderBy('a.'.$orderBy, $order);
    }

    // public function getAllFiltered($orderBy, $order, $pageSize, $page)
    // {
    //     return $this->createQueryBuilder('a')
    //         ->orderBy('a.'.$orderBy, $order)
    //         ->setMaxResults($pageSize)
    //         ->setFirstResult($pageSize * ($page - 1))
    //         ->getQuery()
    //         ->getResult();
    // }
}
