<?php

namespace App\Repository;

use App\Entity\ServicesSupplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ServicesSupplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServicesSupplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServicesSupplier[]    findAll()
 * @method ServicesSupplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServicesSupplierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ServicesSupplier::class);
    }

//    /**
//     * @return ServicesSupplier[] Returns an array of ServicesSupplier objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServicesSupplier
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
