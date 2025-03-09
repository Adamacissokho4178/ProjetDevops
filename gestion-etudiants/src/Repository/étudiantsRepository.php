<?php

namespace App\Repository;

use App\Entity\Ã©tudiants;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ã©tudiants>
 */
class Ã©tudiantsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ã©tudiants::class);
    }

//    /**
//     * @return Ã©tudiants[] Returns an array of Ã©tudiants objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('Ã')
//            ->andWhere('Ã.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('Ã.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ã©tudiants
//    {
//        return $this->createQueryBuilder('Ã')
//            ->andWhere('Ã.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
