<?php

namespace App\Repository;

use App\Entity\DcProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DcProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method DcProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method DcProfile[]    findAll()
 * @method DcProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DcProfileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DcProfile::class);
    }

//    /**
//     * @return DcProfile[] Returns an array of DcProfile objects
//     */
    /*
    public function findByApiKey($apiKey) {
        return $this->createQueryBuilder('u')
            ->andWhere('u.apiKey = :apikey')
            ->setParameter('apikey', $apiKey)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
*/

    /*
    public function findOneBySomeField($value): ?DcProfile
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
