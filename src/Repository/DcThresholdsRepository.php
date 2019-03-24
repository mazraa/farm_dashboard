<?php

namespace App\Repository;

use App\Entity\DcThresholds;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DcThresholds|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcThresholds|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcThresholds[]    findAll()
 * @method DcThresholds[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcThresholdsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DcThresholds::class);
    }

    // /**
    //  * @return DcThresholds[] Returns an array of DcThresholds objects
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

    
    public function findOneBySomeField(): ?DcThresholds
    {
        return $this->createQueryBuilder('d')
            ->orderBy('d.id', 'DESC')
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }
    
}
