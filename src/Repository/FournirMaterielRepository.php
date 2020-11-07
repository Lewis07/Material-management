<?php

namespace App\Repository;

use App\Entity\FournirMateriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FournirMateriel|null find($id, $lockMode = null, $lockVersion = null)
 * @method FournirMateriel|null findOneBy(array $criteria, array $orderBy = null)
 * @method FournirMateriel[]    findAll()
 * @method FournirMateriel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FournirMaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FournirMateriel::class);
    }

    // /**
    //  * @return FournirMateriel[] Returns an array of FournirMateriel objects
    //  */
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
    public function findOneBySomeField($value): ?FournirMateriel
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
