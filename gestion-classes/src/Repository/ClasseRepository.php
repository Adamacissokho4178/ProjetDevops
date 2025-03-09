<?php

// src/Repository/ClasseRepository.php

namespace App\Repository;

use App\Entity\Classe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Classe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classe[]    findAll()
 * @method Classe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClasseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classe::class);
    }

    // Exemple de méthode personnalisée pour trouver une classe par son nom
    public function findByNomClasse($nomClasse)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nomClasse = :nomClasse')
            ->setParameter('nomClasse', $nomClasse)
            ->getQuery()
            ->getResult();
    }

    // Exemple de méthode personnalisée pour récupérer toutes les classes avec un niveau spécifique
    public function findByNiveau($niveau)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.niveau = :niveau')
            ->setParameter('niveau', $niveau)
            ->getQuery()
            ->getResult();
    }
}
