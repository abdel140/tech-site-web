<?php

namespace App\Repository;

use App\Entity\CategoryParent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategoryParent|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryParent|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryParent[]    findAll()
 * @method CategoryParent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryParentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryParent::class);
    }

    // /**
    //  * @return CategoryParent[] Returns an array of CategoryParent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryParent
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
