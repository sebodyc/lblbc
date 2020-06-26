<?php

namespace App\Repository;

use App\Entity\InBox;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InBox|null find($id, $lockMode = null, $lockVersion = null)
 * @method InBox|null findOneBy(array $criteria, array $orderBy = null)
 * @method InBox[]    findAll()
 * @method InBox[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InBoxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InBox::class);
    }

    // /**
    //  * @return InBox[] Returns an array of InBox objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InBox
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
