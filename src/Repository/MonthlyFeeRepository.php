<?php

namespace App\Repository;

use App\Entity\MonthlyFee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MonthlyFee>
 *
 * @method MonthlyFee|null find($id, $lockMode = null, $lockVersion = null)
 * @method MonthlyFee|null findOneBy(array $criteria, array $orderBy = null)
 * @method MonthlyFee[]    findAll()
 * @method MonthlyFee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MonthlyFeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MonthlyFee::class);
    }

//    /**
//     * @return MonthlyFee[] Returns an array of MonthlyFee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MonthlyFee
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
