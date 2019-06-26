<?php

namespace App\Repository;

use App\Entity\AdditionalServices;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AdditionalServices|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdditionalServices|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdditionalServices[]    findAll()
 * @method AdditionalServices[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdditionalServicesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdditionalServices::class);
    }

//    /**
//     * @return AdditionalServices[] Returns an array of AdditionalServices objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdditionalServices
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
