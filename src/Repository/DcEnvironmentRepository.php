<?php

namespace App\Repository;

use App\Entity\DcEnvironment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DcEnvironment|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcEnvironment|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcEnvironment[]    findAll()
 * @method DcEnvironment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcEnvironmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DcEnvironment::class);
    }

    // /**
    //  * @return DcEnvironment[] Returns an array of DcEnvironment objects
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
    public function findOneBySomeField($value): ?DcEnvironment
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function get_environment()
    {   
        $time = date("Y-m-d").' 00:00:00';
        return $this->createQueryBuilder('d')
                    ->andWhere('d.envLastUpdate >= :val')
                    ->setParameter('val', $time)
                    ->orderBy('d.envLastUpdate', 'DESC')
                    ->getQuery()
                    ->getResult();
    }
}
