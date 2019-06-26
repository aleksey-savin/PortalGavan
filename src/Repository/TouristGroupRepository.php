<?php

namespace App\Repository;

use App\Entity\TouristGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TouristGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TouristGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TouristGroup[]    findAll()
 * @method TouristGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TouristGroupRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TouristGroup::class);
    }

//    /**
//     * @return TouristGroup[] Returns an array of TouristGroup objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TouristGroup
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
