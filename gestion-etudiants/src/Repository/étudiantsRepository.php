<?php

namespace App\Repository;

use App\Entity\étudiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<étudiants>
 */
class étudiantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, étudiants::class);
    }

//    /**
//     * @return étudiants[] Returns an array of étudiants objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('�')
//            ->andWhere('�.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('�.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?étudiants
//    {
//        return $this->createQueryBuilder('�')
//            ->andWhere('�.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
