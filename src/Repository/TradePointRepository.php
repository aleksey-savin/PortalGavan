<?php

namespace App\Repository;

use App\Entity\TradePoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TradePoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method TradePoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method TradePoint[]    findAll()
 * @method TradePoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TradePointRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TradePoint::class);
    }

    public function getTradePointsFilteredByDate(\DateTimeInterface $from, \DateTimeInterface $till)
    {
        $qb = $this->createQueryBuilder('t')
            ->select('t, tp')
            ->join('t.purchases', 'tp')
            ->Where('tp.date >= :from and tp.date <= :to')
            ->setParameters(array('from' => $from, 'to' => $till));

        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return TradePoint[] Returns an array of TradePoint objects
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
    public function findOneBySomeField($value): ?TradePoint
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
