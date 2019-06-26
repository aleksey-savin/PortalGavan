<?php

namespace App\Repository;

use App\Entity\ForeignCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ForeignCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method ForeignCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method ForeignCompany[]    findAll()
 * @method ForeignCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ForeignCompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ForeignCompany::class);
    }

    public function getForeignCompaniesFilteredByDate(\DateTimeInterface $from, \DateTimeInterface $till)
    {
        $qb = $this->createQueryBuilder('fc')
            ->select('fc, t')
            ->join('fc.touristGroups', 't')
            ->Where('t.dateOfDeparture >= :from and t.dateOfDeparture <= :to')
            ->setParameters(array('from' => $from, 'to' => $till));

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return ForeignCompany[] Returns an array of ForeignCompany objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ForeignCompany
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
