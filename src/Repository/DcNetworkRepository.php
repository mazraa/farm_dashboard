<?php

namespace App\Repository;

use App\Entity\DcNetwork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DcNetwork|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcNetwork|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcNetwork[]    findAll()
 * @method DcNetwork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcNetworkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DcNetwork::class);
    }

    // /**
    //  * @return DcNetwork[] Returns an array of DcNetwork objects
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

    
    public function findOneBySomeField(): ?DcNetwork
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.id', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
    
}
