<?php

namespace App\Repository;

use App\Entity\DcCapacity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DcCapacity|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcCapacity|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcCapacity[]    findAll()
 * @method DcCapacity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcCapacityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DcCapacity::class);
    }

    // /**
    //  * @return DcCapacity[] Returns an array of DcCapacity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DcCapacity
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
