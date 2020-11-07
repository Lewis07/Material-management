<?php

namespace App\Repository;

use App\Entity\DetenirMobilier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DetenirMobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetenirMobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetenirMobilier[]    findAll()
 * @method DetenirMobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetenirMobilierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetenirMobilier::class);
    }

    // /**
    //  * @return DetenirMobilier[] Returns an array of DetenirMobilier objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetenirMobilier
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
