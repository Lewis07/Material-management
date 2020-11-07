<?php

namespace App\Repository;

use App\Entity\FournirMobilier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FournirMobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method FournirMobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method FournirMobilier[]    findAll()
 * @method FournirMobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FournirMobilierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FournirMobilier::class);
    }

    // /**
    //  * @return FournirMobilier[] Returns an array of FournirMobilier objects
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
    public function findOneBySomeField($value): ?FournirMobilier
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
