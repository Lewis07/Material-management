<?php

namespace App\Repository;

use App\Entity\DetenirMateriel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DetenirMateriel|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetenirMateriel|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetenirMateriel[]    findAll()
 * @method DetenirMateriel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetenirMaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetenirMateriel::class);
    }

    // /**
    //  * @return DetenirMateriel[] Returns an array of DetenirMateriel objects
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
    public function findOneBySomeField($value): ?DetenirMateriel
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
