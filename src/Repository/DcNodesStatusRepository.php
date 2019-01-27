<?php

namespace App\Repository;

use App\Entity\DcNodesStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DcNodesStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcNodesStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcNodesStatus[]    findAll()
 * @method DcNodesStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcNodesStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DcNodesStatus::class);
    }

    // /**
    //  * @return DcNodesStatus[] Returns an array of DcNodesStatus objects
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
    public function findOneBySomeField($value): ?DcNodesStatus
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
