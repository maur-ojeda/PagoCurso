<?php

namespace App\Repository;

use App\Entity\UserStudentCourse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserStudentCourse>
 *
 * @method UserStudentCourse|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStudentCourse|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStudentCourse[]    findAll()
 * @method UserStudentCourse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStudentCourseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserStudentCourse::class);
    }

//    /**
//     * @return UserStudentCourse[] Returns an array of UserStudentCourse objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserStudentCourse
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
